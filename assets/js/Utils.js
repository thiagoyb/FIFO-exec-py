class Utils{
	static isEmail = str =>{
		if(str.indexOf('..')>=0) return false;
		let user = str.substring(0, str.indexOf("@")),
		domain = str.substring(str.indexOf("@")+1, str.length);	
		return (
			(user.length >=1) && (domain.length >=3) && 
			(user.search("@")==-1) && 
			(domain.search("@")==-1) &&
			(user.search(" ")==-1) && 
			(domain.search(" ")==-1) &&
			(domain.search(".")!=-1) &&      
			(domain.indexOf(".") >=1)&& 
			(domain.lastIndexOf(".") < domain.length - 1)
		);
	}

	static logBase = (val, base) =>{
		return Math.log(val)/Math.log(base);
	}
	static byteConvert = bytes =>{
		if(bytes==0) return '0B';
		let s = ['B','K','M','G','T','P','E','Z','Y'];
		let e = Math.floor(Utils.logBase(bytes, 1024));
		return Math.round(bytes/Math.pow(1024, e)).toFixed(2)+s[e];
	}

	static count = (q, root = document) =>{
		return root.querySelectorAll(q).length;
	}

	static mask = (str, pattern) =>{
		let i = 0, val = str.toString();
		return pattern.replace(/#/g, ()=> val[i++] || '');
	}

	static soNumeros = str=>{
		return str.replace(/\D/g,"");
	}
	
	static hasDuplicates(array){
		return (new Set(array)).size!==array.length;
	}

	static getXY(){
		let x = (event.pageX) ? event.pageX : event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
		let y = (event.pageX) ? event.pageY : event.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
		return {x:x,y:y}
	}

	static blank(str) {
		return /^\s*$/.test(str);
	}

	static serial2Obj(str){
		return Object.fromEntries(new URLSearchParams(str));
	}
	static Obj2FD(obj){
		let data = new FormData();
		for(const [key, val] of Object.entries(obj)){
			data.append(key,val);
		}
		return data;
	}

	static click(url='', params={}){
		let a = document.createElement('A');
		for(const [key, val] of Object.entries(params)){
			a.setAttribute(key, val);
		}
		a.target='_self';
		a.href = url;
		document.body.append(a);
		if(url!='') a.click();
		a.remove();
	}

	static getToken(){
		let d = new Date();
		d.setHours(d.getHours()+1);
		return d.getTime();
	}
	static time = ()=>{
		return new Date().getTime();
	}

	static isCPF = cpf =>{
		let soma, rev, iguais=1;
		cpf = cpf.replace(/\D/g,'');
		if(cpf.length != 11){
			return false;
        }
		for(let i = 0; i < cpf.length - 1; i++){
			if(cpf.charAt(i) != cpf.charAt(i + 1)){
				iguais = 0;
				break;
			}
		}
		if(iguais){
			return false;
		}
		soma = 0;
		for(let i=0;i<9;i++){
			soma += parseInt(cpf.charAt(i)) *(10-i);
		}
  		rev = 11 - (soma % 11);
		rev = rev == 10 || rev == 11 ? 0 : rev;
		if(rev != cpf.charAt(9)){
			return false;
		}
		soma = 0;
		for(let i = 0; i < 10; i ++){
			soma += parseInt(cpf.charAt(i)) * (11 - i);
		}
  	  	rev = 11 - (soma % 11);
		rev = rev == 10 || rev == 11 ? 0 : rev;
		if(rev != cpf.charAt(10)){
			return false;
		}
		return true;
	}

	static isCNPJ = cnpj =>{
		let num, dv, soma, i, rev, pos, tamanho, iguais=1;
		cnpj = cnpj.replace(/\D/g,'');
		if(cnpj.length != 14){
			return false;
		}
		for(i = 0; i < cnpj.length - 1; i++){
			if(cnpj.charAt(i) != cnpj.charAt(i + 1)){
				iguais = 0;
				break;
			}
		}
		if(iguais){
			return false;
		}		
		tamanho = cnpj.length - 2;
		num = cnpj.substring(0,tamanho);
		dv = cnpj.substring(tamanho); 
		soma = 0;	pos = tamanho - 7;
		for(i = tamanho; i >= 1; i--){
			soma += num.charAt(tamanho - i) * pos--; 
			if(pos < 2){
				pos = 9;
			}
		}
		rev = soma % 11 < 2 ? 0 : 11 - soma % 11; 
		if(rev != dv.charAt(0)){
			return false;
		}
		tamanho++;
		num = cnpj.substring(0,tamanho);
		soma = 0;	pos = tamanho - 7;
		for(i = tamanho; i >= 1; i--){ 
			soma += num.charAt(tamanho - i) * pos--;
			if(pos < 2){
				pos = 9;
			}
		} 
		rev = soma % 11 < 2 ? 0 : 11 - soma % 11;
		if(rev != dv.charAt(1)){
			return false;
		}
		return true;
	}
	//static teste = ()=>{ console.log(window); }
}