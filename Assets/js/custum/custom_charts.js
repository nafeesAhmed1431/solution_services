let baseUrl = $(base_url).val();
polarTitles = [ 'Total','Completed','Arhcived' ];
polarValues = [
    $('#polarData').data('total'),
    $('#polarData').data('completed'),
    $('#polarData').data('archived')
];

salesTitle = [];
salesValues = [];
$.ajax({
    url : baseUrl + 'Project/generate_salesChart',
    method : 'GET',
    dataType : 'JSON',
    success : callBack => {
        callBack.status == 200 ? generateSalesData(callBack.res) : null ;
    },
    error : res => swal('Error','Something went Wrong Please try again later','error'),
    failure : res => swal('Error','Failure, Please contact System administrator','error')
});

let generateSalesData = res => {
    for(i in res){
        salesTitle .push(res[i].date);
        salesValues.push(res[i].count);
    }
}