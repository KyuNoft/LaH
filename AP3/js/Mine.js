//----------------------------- Alert --------------------------------------//
function sukses_pesanan() {
    swal("Berhasil!", "Pesanan Berhasil ditambahkan!", "success");
}

function sukses() {
	swal("Berhasil!", "Data Berhasil dimasukkan!", "success");
}

function sukses_jadwal() {
    swal("Berhasil!", "Pesanan Berhasil dijadwalkan!", "success");
}

function sukses_generate() {
    swal("Berhasil!", "Biaya Berhasil digeneratekan!", "success");
}

function gagal() {
	swal("Gagal!", "Data Gagal dimasukkan!", "error");
	$('#Tambah').modal('show');
}

function gagal_u() {
    var id = document.getElementById('id').innerHTML;

	swal("Gagal!", "Data Gagal diubah!", "error");
    $('#Ubah'+id+'').modal('show');
}

function modaldetail(){
	$('#ModalDetail').modal('show');
}

//----------------------------- DataTabel ---------------------------------//
$(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

//----------------------------------- Validation --------------------------------------------//
function nameValidation()
{
    var name = document.getElementById('name').value;
     
    if(name==''){
            document.getElementById('nameError').innerHTML="* Name Field cannot be empty";
            document.getElementById('nameError').style.color='red';
            return false;
    }
    if(!name.match(/^[a-zA-Z]+[a-z A-Z]+$/g))
        {
           
            document.getElementById('nameError').innerHTML="* Only Alphabates";
            document.getElementById('nameError').style.color='red';
            return false;
        }
    
    else
     {
            document.getElementById('nameError').innerHTML="Nama Vaild";
            document.getElementById('nameError').style.color='green';
     }
    
}

function emailValidation()
{
    var email = document.getElementById('email').value;  
    if(email==''){
            document.getElementById('emailError').innerHTML="* Email Field cannot be empty";
            document.getElementById('emailError').style.color='red';
            return false;
    }
    if(!email.match(/^[a-zA-Z0-9._]+@[a-zA-Z0-9]+\.(com|org|in|gov)$/))
        {
            document.getElementById('emailError').innerHTML="* Invalid Email";
            document.getElementById('emailError').style.color='red';
            return false;
        }else{
            document.getElementById('emailError').innerHTML="Good";
            document.getElementById('emailError').style.color='green';
        }
}


function mobileValidation()
{
    var mobile = document.getElementById('mobile').value;
    if(!mobile.match(/^[0-9]{10}$/))
        {
            document.getElementById('mobileError').innerHTML="* Only 10 Digits Allowed" ; 
            document.getElementById('mobileError').style.color='red';
            return false;
        }
    else 
        {
            document.getElementById('mobileError').innerHTML="Good" ; 
            document.getElementById('mobileError').style.color='green';
        }

    
}

function passValidation()
{
     var pass = document.getElementById('password').value;
     
    if(pass=='')
        {
            document.getElementById('passError').innerHTML='* Password Cannot be empty';
            document.getElementById('cpassword').disabled=true;
            document.getElementById('passError').style.color='red';
            return false;
        }
    if(!pass.match(/[a-z]/g)){
        document.getElementById('passError').innerHTML='* LowerCase Character missing';
        document.getElementById('passError').style.color='red';
        return false;
    }
    if(!pass.match(/[A-Z]/g)){
        document.getElementById('passError').innerHTML='* UpperCase Character missing';
        document.getElementById('passError').style.color='red';
        return false;
    }
    if(!pass.match(/[0-9]/g)){
        document.getElementById('passError').innerHTML='* Numeric Character missing';
        document.getElementById('passError').style.color='red';
        return false;
    }
    if(!pass.match(/[@+_.?]/g))
        {
            document.getElementById('passError').innerHTML='* password must include @+_.? (atleast one)';
            document.getElementById('passError').style.color='red';
            return false;
        }
    
    else if(pass.length<8)
    {
        document.getElementById('passError').innerHTML='* password must be 8 character long';
        document.getElementById('passError').style.color='red';
        return false;
    }
    else{
        document.getElementById('passError').innerHTML='Good';
        document.getElementById('passError').style.color='green';
        document.getElementById('cpassword').disabled=false;
    }
    
}

function passConfirm()
{
    var cpass= document.getElementById('cpassword').value;
    var pass= document.getElementById('password').value;
    
    
    if(cpass.localeCompare(pass)===0)
    {
        document.getElementById('confError').innerHTML='Password Matched';
        document.getElementById('confError').style.color='green';  
       
    }
    else{
        document.getElementById('confError').innerHTML='* password Does not match';
        document.getElementById('confError').style.color='red';  
        return false;
    }
}

function imgValidation()
{
    var imgPath = document.getElementById('img').value;
    if(imgPath=='')
        {
            document.getElementById('ImgError').innerHTML='* Select the Image';
            document.getElementById('ImgError').style.color='red';  
            return false;
        }
    else{
        var ext = imgPath.substring(imgPath.lastIndexOf('.')+1).toLowerCase();
        if(ext=='jpg'||ext=='jpeg')
            {   
                 document.getElementById('ImgError').innerHTML='Good';
                document.getElementById('ImgError').style.color='green';  
                return true;
            }
        else
        {
            document.getElementById('ImgError').innerHTML='* Only Jpg or jpeg  image allowed';
            document.getElementById('ImgError').style.color='red';  
            return false;
        }
    }
   
}

function validationForm()
{
    if(nameValidation()==false || emailValidation()==false || mobileValidation()==false || passValidation()==false || passConfirm()==false ||imgValidation()==false)
    {
        document.getElementById("button").disabled = true;
    }
    else{
        document.getElementById("button").disabled = false;
    }  
}
//\\----------------------------------- Validation --------------------------------------------\\

//-----------------------------Validation Master Data Akun-----------------------//
function NoAkunValid(){
    var noakun = document.getElementById('NoAkun').value;
    if(noakun == ''){
        document.getElementById('NoAkunError').innerHTML="* Nomor Akun tidak boleh kosong";
        document.getElementById('NoAkunError').style.color='red';
        return false;
    }
    if(!noakun.match(/^[0-9]{3}$/))
    {
        document.getElementById('NoAkunError').innerHTML="* Berisi 3 angka";
        document.getElementById('NoAkunError').style.color='red';
        return false;
    }
    else
    {
        document.getElementById('NoAkunError').innerHTML="No Akun Vaild";
        document.getElementById('NoAkunError').style.color='green';
    }
}

function NamaAkunValid(){
    var NamaAkun = document.getElementById('NamaAkun').value;
    if(NamaAkun == '' || NamaAkun.trim() == ''){
        document.getElementById('NamaAkunError').innerHTML="* Nama Akun tidak boleh kosong";
        document.getElementById('NamaAkunError').style.color='red';
        return false;
    }
    if(!NamaAkun.match(/^[A-z ]{1,40}$/))
    {
        document.getElementById('NamaAkunError').innerHTML="* Maksimal 40 Huruf";
        document.getElementById('NamaAkunError').style.color='red';
        return false;
    }
    if(!NamaAkun.match(/^(?! )/))
    {
        document.getElementById('NamaAkunError').innerHTML="* Tidak boleh diawali dengan Spasi";
        document.getElementById('NamaAkunError').style.color='red';
        return false;
    }
    else
    {
        document.getElementById('NamaAkunError').innerHTML="Nama Akun Vaild";
        document.getElementById('NamaAkunError').style.color='green';
    }
}

function ValidationAkun()
{
    if(NoAkunValid()==false || NamaAkunValid()==false)
    {
        document.getElementById("TambahAkun").disabled = true;
    }
    else{
        document.getElementById("TambahAkun").disabled = false;
    }  
}
//\\-----------------------------Validation Master Data Akun-----------------------\\

//-----------------------------Validation Master Data Pelanggan-----------------------//
function NamaPelangganValid(){
    var NamaPelanggan = document.getElementById('NamaPelanggan').value;
    if(NamaPelanggan == '' || NamaPelanggan.trim() == ''){
        document.getElementById('NamaPelangganError').innerHTML="* Nama Pelanggan tidak boleh kosong";
        document.getElementById('NamaPelangganError').style.color='red';
        return false;
    }
    if(!NamaPelanggan.match(/^[A-z ]{1,30}$/))
    {
        document.getElementById('NamaPelangganError').innerHTML="* Maksimal 30 Huruf";
        document.getElementById('NamaPelangganError').style.color='red';
        return false;
    }
    if(!NamaPelanggan.match(/^(?! )/))
    {
        document.getElementById('NamaPelangganError').innerHTML="* Tidak boleh diawali dengan Spasi";
        document.getElementById('NamaPelangganError').style.color='red';
        return false;
    }
    else
    {
        document.getElementById('NamaPelangganError').innerHTML="Nama Pelanggan Vaild";
        document.getElementById('NamaPelangganError').style.color='green';
    }
}

function NoTelpValid()
{
    var NoTelp = document.getElementById('NoTelp').value;
    if(NoTelp == '' || NoTelp.trim() == ''){
        document.getElementById('NoTelpError').innerHTML="* Nomor Telepon tidak boleh kosong";
        document.getElementById('NoTelpError').style.color='red';
        return false;
    }
    if(!NoTelp.match(/^[0-9]{11,12}$/))
    {
            document.getElementById('NoTelpError').innerHTML="* Minimal 11 dan maksimal 12 digit" ; 
            document.getElementById('NoTelpError').style.color='red';
            return false;
    }
    else 
    {
            document.getElementById('NoTelpError').innerHTML="Nomor Telepon Valid" ; 
            document.getElementById('NoTelpError').style.color='green';
    }
}

function EmailValid()
{
    var Email = document.getElementById('Email').value;  
    if(Email=='' || Email.trim() == '')
    {
            document.getElementById('EmailError').innerHTML="* Email tidak boleh kosong";
            document.getElementById('EmailError').style.color='red';
            return false;
    }
    if(!Email.match(/^[a-zA-Z0-9._]+@[a-zA-Z0-9]+\.(com|org|in|gov)$/))
    {
            document.getElementById('EmailError').innerHTML="* Invalid Email,<br>Ex: fathoniwildan27@gmail.com";
            document.getElementById('EmailError').style.color='red';
            return false;
    }
    if(!Email.match(/^(?! )/))
    {
        document.getElementById('EmailError').innerHTML="* Tidak boleh diawali dengan Spasi";
        document.getElementById('EmailError').style.color='red';
        return false;
    }
    else{
            document.getElementById('EmailError').innerHTML="Email Valid";
            document.getElementById('EmailError').style.color='green';
        }
}

function AlamatValid(){
    var Alamat = document.getElementById('Alamat').value;
    if(Alamat == '' || Alamat.trim() == ''){
        document.getElementById('AlamatError').innerHTML="* Alamat tidak boleh kosong";
        document.getElementById('AlamatError').style.color='red';
        return false;
    }
    if(!Alamat.match(/^[A-z0-9., ]{10,1000}$/))
    {
        document.getElementById('AlamatError').innerHTML="* Minimal 10 Karakter (termasuk ',' '.' 'spasi')";
        document.getElementById('AlamatError').style.color='red';
        return false;
    }
    if(!Alamat.match(/^(?! )/))
    {
        document.getElementById('AlamatError').innerHTML="* Tidak boleh diawali dengan Spasi";
        document.getElementById('AlamatError').style.color='red';
        return false;
    }
    else
    {
        document.getElementById('AlamatError').innerHTML="Alamat Vaild";
        document.getElementById('AlamatError').style.color='green';
    }
}

function ValidationPelanggan()
{
    if(NamaPelangganValid()==false || NoTelpValid()==false || EmailValid()==false || AlamatValid()==false)
    {
        document.getElementById("TambahPelanggan").disabled = true;
    }
    else{
        document.getElementById("TambahPelanggan").disabled = false;
    }  
}
//\\-----------------------------Validation Master Data Pelanggan-----------------------\\

//-----------------------------Validation Master Data BahanBaku-----------------------//
function NamaBahanBakuValid(){
    var NamaBahanBaku = document.getElementById('NamaBahanBaku').value;
    if(NamaBahanBaku == '' || NamaBahanBaku.trim() == ''){
        document.getElementById('NamaBahanBakuError').innerHTML="* Nama Bahan Baku tidak boleh kosong";
        document.getElementById('NamaBahanBakuError').style.color='red';
        return false;
    }
    if(!NamaBahanBaku.match(/^[A-z ]{1,20}$/))
    {
        document.getElementById('NamaBahanBakuError').innerHTML="* Maksimal 20 Huruf";
        document.getElementById('NamaBahanBakuError').style.color='red';
        return false;
    }
    if(!NamaBahanBaku.match(/^(?! )/))
    {
        document.getElementById('NamaBahanBakuError').innerHTML="* Tidak boleh diawali dengan Spasi";
        document.getElementById('NamaBahanBakuError').style.color='red';
        return false;
    }
    else
    {
        document.getElementById('NamaBahanBakuError').innerHTML="Nama Bahan Baku Vaild";
        document.getElementById('NamaBahanBakuError').style.color='green';
    }
}

function SatuanValid(){
    var Satuan = document.getElementById('Satuan').value;
    if(Satuan == '' || Satuan.trim() == ''){
        document.getElementById('SatuanError').innerHTML="* Satuan tidak boleh kosong";
        document.getElementById('SatuanError').style.color='red';
        return false;
    }
    if(!Satuan.match(/^[A-z ]{1,10}$/))
    {
        document.getElementById('SatuanError').innerHTML="* Maksimal 10 Huruf";
        document.getElementById('SatuanError').style.color='red';
        return false;
    }
    if(!Satuan.match(/^(?! )/))
    {
        document.getElementById('SatuanError').innerHTML="* Tidak boleh diawali dengan Spasi";
        document.getElementById('SatuanError').style.color='red';
        return false;
    }
    else
    {
        document.getElementById('SatuanError').innerHTML="Satuan Vaild";
        document.getElementById('SatuanError').style.color='green';
    }
}

function HargaValid()
{
    var Harga = document.getElementById('Harga').value;
    if(Harga == '' || Harga.trim() == ''){
        document.getElementById('HargaError').innerHTML="* Harga tidak boleh kosong";
        document.getElementById('HargaError').style.color='red';
        return false;
    }
    if(!Harga.match(/^[0-9]*$/))
        {
            document.getElementById('HargaError').innerHTML="* Hanya berupa angka" ; 
            document.getElementById('HargaError').style.color='red';
            return false;
        }
    else 
        {
            document.getElementById('HargaError').innerHTML="Harga Valid" ; 
            document.getElementById('HargaError').style.color='green';
        }
}

function ValidationBahanBaku()
{
    if(NamaBahanBakuValid()==false || SatuanValid()==false || HargaValid()==false)
    {
        document.getElementById("TambahBahanBaku").disabled = true;
    }
    else{
        document.getElementById("TambahBahanBaku").disabled = false;
    }  
}
//\\-----------------------------Validation Master Data BahanBaku-----------------------\\

//-----------------------------Validation Master Data Aktivitas-----------------------//
function NamaAktivitasValid(){
    var NamaAktivitas = document.getElementById('NamaAktivitas').value;
    if(NamaAktivitas == '' || NamaAktivitas.trim() == ''){
        document.getElementById('NamaAktivitasError').innerHTML="* Nama Aktivitas tidak boleh kosong";
        document.getElementById('NamaAktivitasError').style.color='red';
        return false;
    }
    if(!NamaAktivitas.match(/^[A-z ]{1,20}$/))
    {
        document.getElementById('NamaAktivitasError').innerHTML="* Maksimal 20 Huruf";
        document.getElementById('NamaAktivitasError').style.color='red';
        return false;
    }
    if(!NamaAktivitas.match(/^(?! )/))
    {
        document.getElementById('NamaAktivitasError').innerHTML="* Tidak boleh diawali dengan Spasi";
        document.getElementById('NamaAktivitasError').style.color='red';
        return false;
    }
    else
    {
        document.getElementById('NamaAktivitasError').innerHTML="Nama Aktivitas Vaild";
        document.getElementById('NamaAktivitasError').style.color='green';
    }
}

function TarifValid()
{
    var Tarif = document.getElementById('Tarif').value;
    if(Tarif == '' || Tarif.trim() == ''){
        document.getElementById('TarifError').innerHTML="* Tarif tidak boleh kosong";
        document.getElementById('TarifError').style.color='red';
        return false;
    }
    if(!Tarif.match(/^[0-9]*$/))
        {
            document.getElementById('TarifError').innerHTML="* Hanya berupa angka" ; 
            document.getElementById('TarifError').style.color='red';
            return false;
        }
    else 
        {
            document.getElementById('TarifError').innerHTML="Tarif Valid" ; 
            document.getElementById('TarifError').style.color='green';
        }
}

function ValidationAktivitas()
{
    if(NamaAktivitasValid()==false || TarifValid()==false)
    {
        document.getElementById("TambahAktivitas").disabled = true;
    }
    else{
        document.getElementById("TambahAktivitas").disabled = false;
    }  
}
//\\-----------------------------Validation Master Data Aktivitas-----------------------\\

//-----------------------------Validation Master Data Mesin-----------------------//
function NamaMesinValid(){
    var NamaMesin = document.getElementById('NamaMesin').value;
    if(NamaMesin == '' || NamaMesin.trim() == ''){
        document.getElementById('NamaMesinError').innerHTML="* Nama Mesin tidak boleh kosong";
        document.getElementById('NamaMesinError').style.color='red';
        return false;
    }
    if(!NamaMesin.match(/^[A-z ]{1,20}$/))
    {
        document.getElementById('NamaMesinError').innerHTML="* Maksimal 20 Huruf";
        document.getElementById('NamaMesinError').style.color='red';
        return false;
    }
    if(!NamaMesin.match(/^(?! )/))
    {
        document.getElementById('NamaMesinError').innerHTML="* Tidak boleh diawali dengan Spasi";
        document.getElementById('NamaMesinError').style.color='red';
        return false;
    }
    else
    {
        document.getElementById('NamaMesinError').innerHTML="Nama Mesin Vaild";
        document.getElementById('NamaMesinError').style.color='green';
    }
}

function TarifValid()
{
    var Tarif = document.getElementById('Tarif').value;
    if(Tarif == '' || Tarif.trim() == ''){
        document.getElementById('TarifError').innerHTML="* Tarif tidak boleh kosong";
        document.getElementById('TarifError').style.color='red';
        return false;
    }
    if(!Tarif.match(/^[0-9]*$/))
        {
            document.getElementById('TarifError').innerHTML="* Hanya berupa angka" ; 
            document.getElementById('TarifError').style.color='red';
            return false;
        }
    else 
        {
            document.getElementById('TarifError').innerHTML="Tarif Valid" ; 
            document.getElementById('TarifError').style.color='green';
        }
}

function ValidationMesin()
{
    if(NamaMesinValid()==false || TarifValid()==false)
    {
        document.getElementById("TambahMesin").disabled = true;
    }
    else{
        document.getElementById("TambahMesin").disabled = false;
    }  
}
//\\-----------------------------Validation Master Data Mesin-----------------------\\

//-----------------------------Validation Master Data Produk-----------------------//
function NamaProdukValid(){
    var NamaProduk = document.getElementById('NamaProduk').value;
    if(NamaProduk == '' || NamaProduk.trim() == ''){
        document.getElementById('NamaProdukError').innerHTML="* Nama Produk tidak boleh kosong";
        document.getElementById('NamaProdukError').style.color='red';
        return false;
    }
    if(!NamaProduk.match(/^[A-z ]{1,20}$/))
    {
        document.getElementById('NamaProdukError').innerHTML="* Maksimal 20 Huruf";
        document.getElementById('NamaProdukError').style.color='red';
        return false;
    }
    if(!NamaProduk.match(/^(?! )/))
    {
        document.getElementById('NamaProdukError').innerHTML="* Tidak boleh diawali dengan Spasi";
        document.getElementById('NamaProdukError').style.color='red';
        return false;
    }
    else
    {
        document.getElementById('NamaProdukError').innerHTML="Nama Produk Vaild";
        document.getElementById('NamaProdukError').style.color='green';
    }
}

function HargaValid()
{
    var Harga = document.getElementById('Harga').value;
    if(Harga == '' || Harga.trim() == ''){
        document.getElementById('HargaError').innerHTML="* Harga tidak boleh kosong";
        document.getElementById('HargaError').style.color='red';
        return false;
    }
    if(!Harga.match(/^[0-9]*$/))
        {
            document.getElementById('HargaError').innerHTML="* Hanya berupa angka" ; 
            document.getElementById('HargaError').style.color='red';
            return false;
        }
    else 
        {
            document.getElementById('HargaError').innerHTML="Harga Valid" ; 
            document.getElementById('HargaError').style.color='green';
        }
}

function ValidationProduk()
{
    if(NamaProdukValid()==false || HargaValid()==false)
    {
        document.getElementById("TambahProduk").disabled = true;
    }
    else{
        document.getElementById("TambahProduk").disabled = false;
    }  
}
//\\-----------------------------Validation Master Data Produk-----------------------\\

jQuery(document).ready(function ($) {

  $('#checkbox').change(function(){
    setInterval(function () {
        moveRight();
    }, 3000);
  });
  
    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width();
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;
    
    $('#slider').css({ width: slideWidth, height: slideHeight });
    
    $('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
    
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });

});    