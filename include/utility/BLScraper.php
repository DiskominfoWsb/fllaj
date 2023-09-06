<?php
date_default_timezone_set('Asia/jakarta');
set_time_limit(0);
error_reporting(0);
class BLScraper{
  function getLink($url){
     $curl_handle=curl_init();
     curl_setopt($curl_handle,CURLOPT_URL,$url);
     curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,0);
     curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
     curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false );
     $result = curl_exec($curl_handle);
     curl_close($curl_handle);
    
     return $result;
  }

  function getData($link){
    $file_contents = str_replace("\n", "", $this->getLink($link));
    $data = array();
    $datas = array();
    preg_match_all("/<li class='col-12--2'>(.*?)<\/li>/s",$file_contents,$data);
    //echo '<pre>'.print_r($data,true);die();

    $no = 1;
    foreach($data[1] as $idx=>$valx){
        preg_match_all("/a title=\"(.*?)\" class/s",$valx,$namax);
        preg_match_all("/data-id='(.*?)'(.*?)data-msg-url-context-class/s",$valx,$id1);
        preg_match_all('/data-reduced-price="(.*?)"(.*?)data-installment/s',$valx,$harga1);
        preg_match_all("/data-url='(.*?)'(.*?)>/s",$valx,$url1);
        preg_match_all('/data-src="(.*?)"(.*?)" srcset/s',$valx,$gambar1);
        preg_match_all('/<a href="(.*?)">/s',$valx,$namatoko1);
        
        //echo '<pre>'.print_r($namax,true);die();

        $nama  = trim($namax[1][0]);
        $id    = $id1[1][0];
        $harga = $harga1[1][0];
        $url   = "https://www.bukalapak.com".$url1[1][0];
        $gambar  = str_replace(".webp", "", $gambar1[1][0]);
        $toko = "https://bukalapak.com".$namatoko1[1][0];
                
        $col_gambar = $this->getDetail($url)['gambar'];
        $deskripsi = $this->getDetail($url)['deskripsi'];
        $kondisi = $this->getDetail($url)['kondisi'];
        $kategori = $this->getDetail($url)['kategori'];
        $berat = $this->getDetail($url)['berat'];
        $stok = $this->getDetail($url)['stok'];
        $sold = $this->getDetail($url)['sold'];
        $spesifikasi = $this->getDetail($url)['spesifikasi'];

        $data = compact('id','nama','harga','url','gambar','toko','col_gambar','deskripsi','kondisi','kategori','berat','stok','spesifikasi','sold');
        $datas[] = $data;
    $no++;
    }
    return $datas;
  }

  function exec($keyword,$page){
    $j = array();
    $j = $this->getData("https://www.bukalapak.com/products?search[keywords]=".$keyword."&page=".$page."&search[sort_by]=weekly_sales_ratio%3Adesc");
    // for ($i=1; $i <= $page ; $i++) { 
    //    array_push($j,$this->getData("https://www.bukalapak.com/products?search[keywords]=".$keyword."&page=".$i.""));
    // }
    // $x = $j;
    //echo '<pre>'.print_r($j,true);die();
    return $j;
    //return htmlspecialchars(json_encode($j), ENT_QUOTES, 'UTF-8');
  }


  function getDetail($link){
    $file_contents = $this->getLink($link);
    $data = array();
    preg_match_all("/<div class='c-panel__body'>(.*?)<div class='u-hr'><\/div>/s",$file_contents,$data);
    $hasil = $data[1][0];
    //echo print_r($hasil,true);die();

    // Start ambil gambar 
    $arr_galeri = array();
    $col_gambar = array();
    preg_match_all("/<picture>(.*?)<\/picture>/s",$hasil,$arr_galeri);
    foreach($arr_galeri[1] as $idx=>$valx){
      preg_match_all('/src="(.*?)" width/s',$valx,$gambar);
      array_push($col_gambar,$gambar[1][0]);
    }
    // End ambil gambar 

    // Start ambil spesifikasi 
    $arr_spek = array();
    $col_spek = array();
    preg_match_all("/<dl class='c-product-spec c-deflist'>(.*?)<\/dl>/s",$hasil,$arr_spek);
    foreach($arr_spek[1] as $spekx=>$valspekx){
      preg_match_all("/class='c-deflist__label qa-pd-attribute-label'>(.*?)<\/dt>/s",$valspekx,$spesifikasilabel);
      preg_match_all("/class='c-deflist__value qa-pd-attribute-value'>(.*?)<\/dd>/s",$valspekx,$spesifikasivalue);
      array_push($col_spek,str_replace("\n", "", $spesifikasilabel[1]));
      array_push($col_spek,str_replace("\n", "", $spesifikasivalue[1]));
    }
    $key = $col_spek[0];
    $value = $col_spek[1]; 
    $spesifikasi = array_combine($key,$value);
    filter_var($spesifikasi, FILTER_SANITIZE_STRING);
    //unset($spesifikasi["Merek"]);
    //echo '<pre>'.print_r($spesifikasi,true).'</pre>';die();
    // End ambil spesifikasi


    preg_match_all("/<h1 class='c-product-detail__name qa-pd-name'>(.*?)<\/h1>/s",$hasil,$namax);
    preg_match_all('/data-reduced-price="(.*?)"(.*?)data-installment/s',$hasil,$hargax);
    preg_match_all("/<div class='js-collapsible-product-detail qa-pd-description u-txt--break-all'>(.*?)<\/div>/s",$hasil,$deskripsi1);
    preg_match_all('/c-deflist__value qa-pd-condition-value(.*?)"(.*?)"(.*?)>(.*?)<\/span>/s',$hasil,$kondisix);
    preg_match_all("/c-deflist__value qa-pd-category-value qa-pd-category'>(.*?)<\/dd>/s",$hasil,$kategorix);
    preg_match_all("/c-deflist__value qa-pd-weight-value qa-pd-weight'>(.*?)<\/dd>/s",$hasil,$beratx);
    preg_match_all("/strong class='u-fg--black'>(.*?)>(.*?)<\/span>/s",$hasil,$stokx);
    preg_match_all("/<dd class='c-deflist__value qa-pd-sold-value'>(.*?)<\/dd>/s",$hasil,$soldx);

    //echo '<pre>'.print_r($soldx[1][0],true).'</pre>';die();   

    $deskripsi = trim($deskripsi1[1][0]);
    $gambar = str_replace("thumb", "w-600", $col_gambar);
    $kondisi = $kondisix[4][0];
    $kategori = trim($kategorix[1][0]);
    $berat = trim($beratx[1][0]);
    $sold = trim($soldx[1][0]);
    $stok = trim(str_replace(array("stok"," ",">","&gt;"),"",$stokx[2][0]));
    //print_r($stok);die();
    return array('gambar'      => $gambar,
                 'deskripsi'   => $deskripsi , 
                 'kondisi'     => $kondisi,
                 'kategori'    => $kategori,
                 'berat'       => $berat,
                 'stok'        => $stok,
                 'sold'        => $sold,
                 'spesifikasi' => $spesifikasi
                );
    
  }


}

// $scraper = new BLScraper();
// $result = $scraper->exec("canon+ef+24",1);
// echo htmlspecialchars(json_encode($result), ENT_QUOTES, 'UTF-8');
//echo '<pre>'.print_r($result,true).'</pre>';

//$scraper->getDetail("https://www.bukalapak.com/p/handphone/hp-smartphone/80k355-jual-samsung-e1050?dtm_source=product_detail&dtm_section=detail-1&dtm_campaign=related");

?>