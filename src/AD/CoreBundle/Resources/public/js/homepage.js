var dropzoneHomePageMain = new Dropzone("#homepage-main-image", {
	autoQueue : false,
	parallelUploads : 1,
	chunking : false,
	resizeQuality : 1,
	maxFiles: 1,
});

var dropzoneHomePageSecondary = new Dropzone("#homepage-secondary-image", {
	autoQueue : false,
	parallelUploads : 1,
	chunking : false,
	resizeQuality : 0.6,
	maxFiles: 1,
});


var trgHeight = 200;
var trgWidth = 200;



dropzoneHomePageSecondary.on("addedfile", function(file) {
	var reader = new FileReader();
    reader.onload = (function () {
        return (function (e) {
            var image = new Image();
            image.onload = function () {
                (function (file, uri) {
                    EXIF.getData(file, function () {
                        var imgToSend = processImg(
                        uri,
                        trgHeight, trgWidth,
                        this.width, this.height,
                        EXIF.getTag(file, 'Orientation'));

                        console.log(imgToSend);

                        console.log("Width:" +this.width);
                        console.log("Height:" +this.height);
                        
                        
                        
                        var imgUpload = processImg(
                                uri,
                                this.width ,this.height ,
                                this.width, this.height,
                                EXIF.getTag(file, 'Orientation'));
                       
                        var rotatedFile = base64ToFile(imgUpload, file);
                        
                        var origFileIndex = dropzoneHomePageSecondary.files.indexOf(file);
                        console.log("Index : "+origFileIndex)
                        dropzoneHomePageSecondary.files[origFileIndex] = rotatedFile;
                        
                        dropzoneHomePageSecondary.enqueueFile(rotatedFile);
                        
                        //Promise
                        //    .resolve($.post('http://example.com', {img: imgToSend}))
                        //    .then(console.log('Image was sent !'));
                    });
                })(file, e.target.result);
            };
            image.src = e.target.result;
        })
    })(file);
    reader.readAsDataURL(file);
});





dropzoneHomePageMain.on('addedfile', function (file) {
    var reader = new FileReader();
    reader.onload = (function () {
        return (function (e) {
            var image = new Image();
            image.onload = function () {
                (function (file, uri) {
                    EXIF.getData(file, function () {
                        var imgToSend = processImg(
                        uri,
                        trgHeight, trgWidth,
                        this.width, this.height,
                        EXIF.getTag(file, 'Orientation'));

                        console.log(imgToSend);

                        console.log("Width:" +this.width);
                        console.log("Height:" +this.height);
                        
                        
                        
                        var imgUpload = processImg(
                                uri,
                                this.width ,this.height ,
                                this.width, this.height,
                                EXIF.getTag(file, 'Orientation'));
                       
                        var rotatedFile = base64ToFile(imgUpload, file);
                        
                        var origFileIndex = dropzoneHomePageMain.files.indexOf(file);
                        console.log("Index : "+origFileIndex)
                        dropzoneHomePageMain.files[origFileIndex] = rotatedFile;
                        
                        dropzoneHomePageMain.enqueueFile(rotatedFile);
                        
                        //Promise
                        //    .resolve($.post('http://example.com', {img: imgToSend}))
                        //    .then(console.log('Image was sent !'));
                    });
                })(file, e.target.result);
            };
            image.src = e.target.result;
        })
    })(file);
    reader.readAsDataURL(file);
});
