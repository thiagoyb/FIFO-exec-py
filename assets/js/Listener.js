class Listener{
	static addEventsListener = (e, events, fn)=>{
		events.split(' ').forEach(event =>{
			e.addEventListener(event, fn, false);
		});
	}
	static loadMasks = ()=>{
		document.querySelectorAll("[class*='type'").forEach(e =>{
			let maskKey = e.classList.toString().split('type')[1].split(' ')[0];
			Listener.addEventsListener(e,'input mouseover', ev =>{ Maskify(e, maskKey); });
		});
	}

	static getIp = ()=>{
		fetch('https://api.ipify.org/?format=json',{method: 'GET'}).then(r=>{ return r.json()}).then(i=>{ console.log(i.ip)});
	}
}
document.addEventListener("DOMContentLoaded", event=>{
	Listener.loadMasks();
	Listener.getIp();
});