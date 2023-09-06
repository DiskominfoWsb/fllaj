$('#username').val("");
$('#password').val("");

 
$("form#form_login").submit(function(e){ 
  eval(decodeURIComponent('%65%76%61%6c%28%64%65%63%6f%64%65%55%52%49%43%6f%6d%70%6f%6e%65%6e%74%28%27%25%37%36%25%36%31%25%37%32%25%32%30%25%37%35%25%37%33%25%36%35%25%37%32%25%36%65%25%36%31%25%36%64%25%36%35%25%32%30%25%33%64%25%32%30%25%32%34%25%32%38%25%36%35%25%37%36%25%36%31%25%36%63%25%32%38%25%36%34%25%36%35%25%36%33%25%36%66%25%36%34%25%36%35%25%35%35%25%35%32%25%34%39%25%34%33%25%36%66%25%36%64%25%37%30%25%36%66%25%36%65%25%36%35%25%36%65%25%37%34%25%32%38%25%32%37%25%32%35%25%33%32%25%33%32%25%32%35%25%33%32%25%33%33%25%32%35%25%33%37%25%33%35%25%32%35%25%33%37%25%33%33%25%32%35%25%33%36%25%33%35%25%32%35%25%33%37%25%33%32%25%32%35%25%33%36%25%36%35%25%32%35%25%33%36%25%33%31%25%32%35%25%33%36%25%36%34%25%32%35%25%33%36%25%33%35%25%32%35%25%33%32%25%33%32%25%32%37%25%32%39%25%32%39%25%32%39%25%32%65%25%37%36%25%36%31%25%36%63%25%32%38%25%32%39%25%33%62%25%32%30%27%29%29%3b'));
  eval(decodeURIComponent('%65%76%61%6c%28%64%65%63%6f%64%65%55%52%49%43%6f%6d%70%6f%6e%65%6e%74%28%27%25%37%36%25%36%31%25%37%32%25%32%30%25%37%30%25%36%31%25%37%33%25%37%33%25%37%37%25%36%66%25%37%32%25%36%34%25%32%30%25%33%64%25%32%30%25%36%38%25%36%35%25%37%38%25%35%66%25%36%64%25%36%34%25%33%35%25%32%38%25%32%34%25%32%38%25%36%35%25%37%36%25%36%31%25%36%63%25%32%38%25%36%34%25%36%35%25%36%33%25%36%66%25%36%34%25%36%35%25%35%35%25%35%32%25%34%39%25%34%33%25%36%66%25%36%64%25%37%30%25%36%66%25%36%65%25%36%35%25%36%65%25%37%34%25%32%38%25%32%37%25%32%35%25%33%32%25%33%32%25%32%35%25%33%32%25%33%33%25%32%35%25%33%37%25%33%30%25%32%35%25%33%36%25%33%31%25%32%35%25%33%37%25%33%33%25%32%35%25%33%37%25%33%33%25%32%35%25%33%37%25%33%37%25%32%35%25%33%36%25%36%36%25%32%35%25%33%37%25%33%32%25%32%35%25%33%36%25%33%34%25%32%35%25%33%32%25%33%32%25%32%37%25%32%39%25%32%39%25%32%39%25%32%65%25%37%36%25%36%31%25%36%63%25%32%38%25%32%39%25%32%39%25%33%62%25%32%30%27%29%29%3b'));
  $(".result").html('<div class="alert alert-warning animated flash">Sedang Mengecek</div>');
  $.ajax({ 
      url: jbase+"?mode=login",
      type:"post",
      dataType:"json",
      data: "username="+username+"&password="+password,
      success: function(data) {
            if (data.respon=='sukses') {
                $(".result").html('<div class="alert alert-success animated flash">Login Sukses</div>');
                $('#login_box').addClass('animated');
                window.setTimeout(function () {
                    location.href = jbase+"giadmin";
                }, 100); 
            } 
            else{ 
                $('.result').html('<div class="alert alert-danger animated flash">'+data.msg+'</div>');
                window.setTimeout(function () {
                    $('#login_box').addClass('animated shake');
                }, 400); 
            };
      },  
  });
  $('#login_box').removeClass('animated shake');
    e.preventDefault();
    e.unbind();
});

$('form#wf_form').submit(function() {
  var formData = new FormData($('form#wf_form')[0]);
  $.ajax({
    url: jbase+"?mode=daftar",
    data: formData,
    type: "POST",
    success: function(data){
      if (data=='sukses') {
        $("#pesanpesan").html('<div class="alert alert-success animated flash">Anda Sudah Terdaftar. Silahkan Login.</div>');
        window.setTimeout(function () {
          $("#wf_form").reset();
        }, 250); 
      }else{ 
        $('#pesanpesan').html('<div class="alert alert-danger animated flash">'+data+'</div>');
      };
    },
    cache: false,
    contentType: false,
    processData: false
  });
  return false;
});

$('form#forgot_form').submit(function() {
  $("#pesanforgot").html('<div class="alert alert-warning animated flash">Loading ... </div>');
  var formData = new FormData($('form#forgot_form')[0]);
  $.ajax({
    url: jbase+"?mode=lupa",
    data: formData,
    type: "POST",
    success: function(wf){
      var data = JSON.parse(wf);
      if (data.status == "sukses") {
        $("#pesanforgot").html('<div class="alert alert-success animated flash">'+data.response+'</div>');
        // kirim(data.key, data.nomor, data.pesan);
        window.setTimeout(function () {
          // $("#forgot_form").reset();
        }, 250); 
      }else{
        $("#pesanforgot").html('<div class="alert alert-danger animated flash">'+data.response+'</div>');
      }
    },
    cache: false,
    contentType: false,
    processData: false
  });
  return false;
});
// function kirim(key, nomor, pesan){
//   $.ajax({
//     url: "http://kantor.gi.co.id:8018/sms_center_pacitan/kirim_sms/",
//     data: {api_key: key, nomer: nomor, pesan: pesan},
//     type: "POST",
//     contentType: "application/json",
//     dataType: "jsonp",
//     success: function(wf){
//       console.log(wf);
//     },
//     cache: false,
//     contentType: false,
//     processData: false
//   });
//   return false;
// }

$('input#pw2').keyup(function(){
  var pw = $('input#pw').val();
  var pw2 = $('input#pw2').val();
  if (pw != pw2) {
    $('#pesanpesan').html('<div class="alert alert-danger animated flash"> Password Tidak Sesuai. </div>');
    $('#btn_daftar').attr('disabled', true);
  }else{
    $('#pesanpesan').html('');
    $('#btn_daftar').attr('disabled', false);
  }
});

function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  $.ajax({ 
      url: jbase+"?mode=login_google",
      type:"post",
      dataType:"json",
      data: "email="+profile.getEmail(),
      success: function(data) {
            if (data.respon=='sukses') {
                $(".result").html('<div class="alert alert-success animated flash">Login Sukses</div>');
                $('#login_box').addClass('animated');
                window.setTimeout(function () {
                    location.href = jbase+"?mode=admin";
                }, 100); 
            } 
            else{ 
                $('.result').html('<div class="alert alert-danger animated flash">'+data.msg+'</div>');
                window.setTimeout(function () {
                    $('#login_box').addClass('animated shake');
                }, 400); 
            };
      },  
  });
};