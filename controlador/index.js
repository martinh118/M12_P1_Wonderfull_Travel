/**
 * Retorna l'hora i data i, en alguns casos, un missatge.
 *
 * @param {Date} ara	Data i hora actual en un objecte de tipus Date
 *
 * @return {string}		Text HTML amb la següent informació:
 * 						HH:MM:SS {AM|PM}<br>
 * 						Dia de la setmana<br>
 * 						[D]D / [M]M / AAAA
 * 		A més, també ha de proporcionar les següents informacions, afegint <br> al davant:
 * 			Si és migdia (12:00 PM): Són les 12 del migdia. Tens una hora per anar a dinar.
 * 			Si és mitjanit (00:00 AM):
 * 				Si és Cap d'any (1 de gener): Bon any !!!
 * 				Si és Nadal (25 de desembre): Bon Nadal !!!
 * 				Si no és cap dels anteriors: És mitjanit. No hauries d'estar dormint?
 * 			Si és any de traspàs (bisiesto):
 * 				A les 08:00 AM de l'1 de gener: Bon dia. Aquest serà un any especial.
 * 				A les 08:00 AM del 29 de febrer: Bon dia. Avui és un dia especial.
 */
function rellotge(ara) {
	const weekday = ["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"];

	let tiempo = AMPM(ara); 
	let diaSemana = ara.getDay();
	let fecha = ara.getDate() + ' / ' + arreglarMes(ara) + ' / ' + ara.getFullYear();
	

	let texto =`${tiempo}<br>${weekday[diaSemana]}&nbsp${fecha}` ;
	
	return texto;
}

function arreglarMes(tiemp){
	let meses = [1,2,3,4,5,6,7,8,9,10,11,12];

	return meses[tiemp.getMonth()];

}

function AMPM(tiempo){
	let horasAM = [12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
	let horasPM = [12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23];
	let hora = 0;
	if(tiempo.getHours() >= 12 && tiempo.getHours() <= 23){
		hora = horasPM.indexOf(tiempo.getHours());
		hora = horasAM[hora];
		return cero(hora) + ":" + cero(tiempo.getMinutes()) + ":" + cero(tiempo.getSeconds())+' PM';
	}else return cero(tiempo.getHours()) + ":" +cero(tiempo.getMinutes()) + ":" + cero(tiempo.getSeconds())+' AM';

}

function cero(num){
	if(num < 10){
		return '0'+num;
	}else return num;
}

function selecPais(){

    let continente = document.getElementById("continent").value;
    let paises = document.getElementById("pais");
    let texto;

    switch(continente){
        case "Asia":
            texto = "<option>China</option><option>Rusia</option><option>India</option>";
            break;
        case "Europa":
            texto = "<option>España</option><option>Holanda</option><option>Italia</option>";
            break;
        case "Africa":
            texto = "<option>Kenia</option><option>Nigeria</option><option>Sudán</option>";
            break;
        case "America del Norte":
            texto = "<option>Canada</option><option>Estados Unidos</option><option>Mexico</option>";
            break;
        case "America del Sur":
            texto = "<option>Brazil</option><option>Argentina</option><option>Perú</option>";
            break;
        case "Oceanía":
            texto = "<option>Australia</option><option>Fiji</option><option>Nueva Zelanda</option>";
            break;
        default:
            texto = "<option>China</option><option>Rusia</option><option>India</option>";
            break;
    }

    paises.innerHTML= texto;

}

function selecImagenPais(){
    let pais = document.getElementById("pais").value;

    const paises={
        China: '../source/optimizadas/asia/china/china_peq.webp',
        Rusia: '../source/optimizadas/asia/rusia/rusia_peq.webp',
        India: '../source/optimizadas/asia/india/india_peq.webp',
        España: '../source/optimizadas/europa/spain/spain_peq.webp',
        Holanda: '../source/optimizadas/europa/holand/holand_peq.webp',
        Italia: '../source/optimizadas/europa/italia/italia_peq.webp',
        Kenia: '../source/optimizadas/africa/kenia/kenia_peq.webp',
        Nigeria: '../source/optimizadas/africa/nigeria/nigeria_peq.webp',
        'Sudán': '../source/optimizadas/africa/sudan/sudan_peq.webp',
        Canada: '../source/optimizadas/america_norte/canada/canada_peq.webp',
        'Estados Unidos': '../source/optimizadas/america_norte/estados_unidos/estados_unidos_peq.webp',
        Mexico: '../source/optimizadas/america_norte/mexico/mexico_peq.webp',
        Brazil: '../source/optimizadas/america_sur/brazil/brazil_peq.webp',
        Argentina: '../source/optimizadas/america_sur/argentina/argentina_peq.webp',
        'Perú': '../source/optimizadas/america_sur/peru/peru_peq.webp',
        Australia: '../source/optimizadas/oceania/australia/australia_peq.webp',
        Fiji: '../source/optimizadas/oceania/fiji/fiji_peq.webp',
        'Nueva Zelanda': '../source/optimizadas/oceania/nueva_zelanda/nueva_zelanda_peq.webp'
    }

    document.getElementById("imagen").src = paises[pais] || "";
    
}



/************************************************
* FINAL DE L'APARTAT ON PODEU FER MODIFICACIONS *
************************************************/

function clock() {
	document.getElementById('data').innerHTML = rellotge(new Date());
}

setInterval(clock, 1000);
document.getElementById("continent").addEventListener("change", function(){
    selecPais();
    selecImagenPais();});
document.getElementById("pais").addEventListener("change", selecImagenPais);