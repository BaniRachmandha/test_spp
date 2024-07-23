var container = document.getElementById("kt_docs_vistimeline_style");

// Generate HTML content
const getContent = (title, img) => {
    const item = document.createElement('div');
    const name = document.createElement('div');
    const nameClasses = ['fw-bolder', 'mb-2'];
    name.classList.add(...nameClasses);
    name.innerHTML = title;

    const image = document.createElement('img');
    image.setAttribute('src', img);

    const symbol = document.createElement('div');
    const symbolClasses = ['symbol', 'symbol-circle', 'symbol-30'];
    symbol.classList.add(...symbolClasses);
    symbol.appendChild(image);

    item.appendChild(name);
    item.appendChild(symbol);

    return item;
}

// note that months are zero-based in the JavaScript Date object
var items = new vis.DataSet([
    {
        start: new Date(2023, 7, 23),
        content: getContent('IPPJU/IPPBP', './assets/media/avatars/300-6.jpg')
    },
    {
        start: new Date(2023, 7, 23, 23, 0, 0),
        content: getContent('IMP & SJUT', './assets/media/avatars/300-1.jpg')
    },
    { start: new Date(2023, 7, 24, 16, 0, 0), content: "Non Perizinan" },
    {
        start: new Date(2023, 7, 26),
        end: new Date(2023, 8, 2),
        content: "Storing",
    },
    {
        start: new Date(2023, 7, 28),
        content: getContent('Stlak', './assets/media/avatars/300-2.jpg')
    },
    {
        start: new Date(2023, 7, 29),
        content: getContent('PHO', './assets/media/avatars/300-5.jpg')
    },
    {
        start: new Date(2023, 7, 31),
        end: new Date(2023, 8, 3),
        content: "FHO",
    },
    // {
    //     start: new Date(2023, 8, 4, 12, 0, 0),
    //     content: getContent('Report', './assets/media/avatars/300-20.jpg')
    // },
]);

var options = {
    editable: true,
    margin: {
        item: 20,
        axis: 40,
    },
};

var status = {
	1: {"title": "Pending", "state": "primary"},
	2: {"title": "Delivered", "state": "danger"},
	3: {"title": "Canceled", "state": "primary"},
	4: {"title": "Success", "state": "success"},
	5: {"title": "Info", "state": "info"},
	6: {"title": "Danger", "state": "danger"},
	7: {"title": "Warning", "state": "warning"},
};

function ippju(){
	app.goUrl(app.get('suburl')+'/eks/permohonan');
}
function imp(){
	app.goUrl(app.get('suburl')+'/eks/permohonanimp');
}
function nonizin(){
	app.goUrl(app.get('suburl')+'/eks/permohonannonizin');
}
function storing(){
	app.goUrl(app.get('suburl')+'/eks/permohonanstoring');
}
function stlak(){
	app.goUrl(app.get('suburl')+'/eks/permohonanstlak');
}
function pho(){
	app.goUrl(app.get('suburl')+'/eks/permohonanpho');
}
function fho(){
	app.goUrl(app.get('suburl')+'/eks/permohonanfho');
}
$(function() {
	$('.mn-beranda').addClass('active');
	var timeline = new vis.Timeline(container, items, options);
	$("#kt_datatable_fixed_header").DataTable({
		"fixedHeader": {
			"header":true
		},
		"columnDefs": [
			{
				// The `data` parameter refers to the data for the cell (defined by the
				// `data` option, which defaults to the column being worked with, in
				// this case `data: 0`.
				"render": function ( data, type, row ) {
					var index = KTUtil.getRandomInt(1, 7);

					return data + '<span class="ms-2 badge badge-light-' + status[index]['state'] + ' fw-semibold">' + status[index]['title'] + '</span>';
				},
				"targets": 1
			}
		]
	});
}); 
