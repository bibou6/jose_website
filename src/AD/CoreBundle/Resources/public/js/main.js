function getOrientation(file, callback) {
	var reader = new FileReader();
	reader.onload = function(e) {

		var view = new DataView(e.target.result);
		if (view.getUint16(0, false) != 0xFFD8) {
			return callback(-2);
		}
		var length = view.byteLength, offset = 2;
		while (offset < length) {
			if (view.getUint16(offset + 2, false) <= 8)
				return callback(-1);
			var marker = view.getUint16(offset, false);
			offset += 2;
			if (marker == 0xFFE1) {
				if (view.getUint32(offset += 2, false) != 0x45786966) {
					return callback(-1);
				}

				var little = view.getUint16(offset += 6, false) == 0x4949;
				offset += view.getUint32(offset + 4, little);
				var tags = view.getUint16(offset, little);
				offset += 2;
				for (var i = 0; i < tags; i++) {
					if (view.getUint16(offset + (i * 12), little) == 0x0112) {
						return callback(view.getUint16(offset + (i * 12) + 8,
								little));
					}
				}
			} else if ((marker & 0xFF00) != 0xFF00) {
				break;
			} else {
				offset += view.getUint16(offset, false);
			}
		}
		return callback(-1);
	};
	reader.readAsArrayBuffer(file);
}

function base64ToFile(dataURI, origFile) {
	var byteString, mimestring;

	if (dataURI.split(',')[0].indexOf('base64') !== -1) {
		byteString = atob(dataURI.split(',')[1]);
	} else {
		byteString = decodeURI(dataURI.split(',')[1]);
	}

	mimestring = dataURI.split(',')[0].split(':')[1].split(';')[0];

	var content = new Array();
	for (var i = 0; i < byteString.length; i++) {
		content[i] = byteString.charCodeAt(i);
	}

	var newFile = new File([ new Uint8Array(content) ], origFile.name, {
		type : mimestring
	});

	// Copy props set by the dropzone in the original file

	var origProps = [ "upload", "status", "previewElement", "previewTemplate",
			"accepted" ];

	$.each(origProps, function(i, p) {
		newFile[p] = origFile[p];
	});

	return newFile;
}

function processImg(image, maxWidth,maxHeight, srcWidth, srcHeight, orientation){
	
 	var img = new Image;
    img.src = image;

	var degrees = 0;
    if (orientation == 3) degrees=180;
    if (orientation == 6) degrees=90;
    if (orientation == 8) degrees=90;
    
    if (degrees >= 360) degrees = 0;

    var trgWidth = srcWidth;
    var trgHeight = srcHeight;
    // Resize
    if (srcWidth > maxWidth || srcHeight > maxHeight) {
		if (srcWidth > srcHeight) {
			if (srcWidth > maxWidth) {
				trgHeight *= maxWidth / srcWidth;
				trgWidth = maxWidth;
			}
		} else {
			if (srcHeight > maxHeight) {
				trgWidth *= maxHeight / srcHeight;
				trgHeight = maxHeight;
			}
		}
	}
    
    var canvas = document.createElement('canvas');
    
    
    if (degrees === 0 || degrees === 180) {
        canvas.width = trgWidth;
        canvas.height = trgHeight;
    }
    else {
        // swap
        canvas.width = trgHeight;
        canvas.height = trgWidth;
    }
    
    
    
    
    var ctx = canvas.getContext("2d");
    
    if (degrees === 90 || degrees === 270) {
    	ctx.translate(srcHeight/2,srcWidth/2);
    	ctx.rotate(degrees*Math.PI/180);
    	ctx.drawImage(img,0,0,srcWidth,srcHeight,-trgWidth/2,-trgHeight/2,trgWidth,trgHeight)
    }else{
    	//ctx.drawImage(img,0,0,srcWidth,srcHeight,-srcWidth/2,-srcHeight/2,trgWidth,trgHeight);
    	ctx.drawImage(img,0,0,trgWidth,trgHeight);
    }
    
    return canvas.toDataURL();
    
}
