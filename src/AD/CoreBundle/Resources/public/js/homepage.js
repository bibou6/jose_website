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






dropzoneHomePageSecondary.on("addedfile", function(origFile) {
	var MAX_WIDTH = 700;
	var MAX_HEIGHT = 700;

	var reader = new FileReader();

	// Convert file to img

	reader.addEventListener("load", function(event) {

		var origImg = new Image();
		origImg.src = event.target.result;

		origImg.addEventListener("load", function(event) {

			var width = event.target.width;
			var height = event.target.height;

			getOrientation(origFile,
				function(orientation) {
				// Don't resize if it's small enough

				if (width > MAX_WIDTH && height > MAX_HEIGHT) {
					if (width > height) {
						if (width > MAX_WIDTH) {
							height *= MAX_WIDTH / width;
							width = MAX_WIDTH;
						}
					} else {
						if (height > MAX_HEIGHT) {
							width *= MAX_HEIGHT / height;
							height = MAX_HEIGHT;
						}
					}
				}
				// Resize & rotate
				
				var degree = 0;
				switch (orientation) {
					case 3:
						degree = 180;
						break;
					case 6:
						degree = -90;
						break;
					case 8:
						degree = 90;
						break;
				}

				var canvas = document.createElement('canvas');
				canvas.width = width;
				canvas.height = height;

				var ctx = canvas.getContext("2d");
				ctx.translate(canvas.width/2, canvas.height/2);
				ctx.rotate(Math.PI / 180 *degree);
				
				
				ctx.drawImage(origImg,-width/2,-height/2, width, height);
				
				
				var resizedFile = base64ToFile(canvas.toDataURL(), origFile);

				// Replace original with resized

				var origFileIndex = dropzoneHomePageSecondary.files.indexOf(origFile);
				dropzoneHomePageSecondary.files[origFileIndex] = resizedFile;

				// Enqueue added file manually making it available for
				// further processing by dropzoneHomePageSecondary

				dropzoneHomePageSecondary.enqueueFile(resizedFile);
					});

			
		});
	});

	reader.readAsDataURL(origFile);
});





dropzoneHomePageMain.on("addedfile", function(origFile) {
	var MAX_WIDTH = 700;
	var MAX_HEIGHT = 700;

	var reader = new FileReader();

	// Convert file to img

	reader.addEventListener("load", function(event) {

		var origImg = new Image();
		origImg.src = event.target.result;

		origImg.addEventListener("load", function(event) {

			var width = event.target.width;
			var height = event.target.height;

			getOrientation(origFile,
				function(orientation) {
				// Don't resize if it's small enough

				
				var degree = 0;
				switch (orientation) {
					case 3:
						degree = 180;
						break;
					case 6:
						degree = -90;
						break;
					case 8:
						degree = 90;
						break;
				}

				var canvas = document.createElement('canvas');
				canvas.width = width;
				canvas.height = height;

				var ctx = canvas.getContext("2d");
				ctx.translate(canvas.width/2, canvas.height/2);
				ctx.rotate(Math.PI / 180 *degree);
				
				
				ctx.drawImage(origImg,-width/2,-height/2, width, height);
				
				
				var resizedFile = base64ToFile(canvas.toDataURL(), origFile);

				// Replace original with resized

				var origFileIndex = dropzoneHomePageMain.files.indexOf(origFile);
				dropzoneHomePageMain.files[origFileIndex] = resizedFile;

				// Enqueue added file manually making it available for
				// further processing by dropzoneHomePageMain

				dropzoneHomePageMain.enqueueFile(resizedFile);
					});

			
		});
	});

	reader.readAsDataURL(origFile);
});
