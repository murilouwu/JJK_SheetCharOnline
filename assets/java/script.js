function PreViewImg(input, imgPreview){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(imgPreview).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function subir(){
	window.scrollTo(0, 0);
}

function mostrar(ocu, chave){
    for (var i=0; i<ocu.length; i++){	
		if (i<chave){
			ocultar(ocu[i], 0);	
		}else{
			ocultar(ocu[i], 1);
		};
	};
};

function ocultar(obj, es){
	let div = document.querySelector(obj);
	if(es==1){
		div.style.display = 'flex';
	}else{
		div.style.display = 'none';
	};
};

function redirect(page) {
    window.location.href = page;
}

function redirectNewPage(link){
    window.open(link, '_blank');
}

function Scroll0Display(item) {
	let fun = window.scrollY === 0 ? 0 : 1;
	ocultar(item, fun);
}

function adamCendler(id){
	let btn = document.querySelector(id);
	btn.click();
}

function Copy(btn, textArea){
	let resultBlock = document.querySelector(textArea);
	
	const tempTextArea = document.createElement('textarea');
    tempTextArea.value = resultBlock.innerText;
	document.body.appendChild(tempTextArea);
    tempTextArea.select();
    document.execCommand('copy');
	document.body.removeChild(tempTextArea);

	btn.setAttribute('disabled', 'disabled');
}