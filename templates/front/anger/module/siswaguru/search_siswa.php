<?php
	$wf = false;
	$no = 1;
	$result = json_decode($result, JSON_FORCE_OBJECT);
	foreach ($result as $r) {
		if ($no % 3 == 1) {
			$wf .= '<div class="row animation" data-animation="fadeInUp" data-animation-delay="0.2s">';
		}
		$wf .= '<div class="col-lg-4 col-sm-6 mb-4 pb-sm-2 text-center">
			<div class="team_box light_gray_bg">
				<div class="team_img" onclick="preview('.$r['foto'].');"  style="width: 100%; height: 250px; background-image: url('.$r['foto'].'); background-size: cover; background-position: center;">
				</div>
            	<div class="team_title">
                    <h6><small><b>'.$r['nama_lengkap'].'</b></small></h6>
                    <span><small>NIS. '.$r['nis'].'</small></span>
                </div>
                <ul class="list_none social_icons border_social">
                    <li><a href="'.$r['fb'].'"><i class="ion-social-facebook"></i></a></li>
                    <li><a href="'.$r['tw'].'"><i class="ion-social-twitter"></i></a></li>
                    <li><a href="'.$r['ig'].'"><i class="ion-social-instagram-outline"></i></a></li>
                </ul>
                <ul class="list_none border_social" style="margin: 5px;">
                	<li><a style="padding: 5px;" href="'.ROOTDIR.$r['link'].'">Detail <i class="fa fa-arrow-right"></i></a></li>
                </ul>
            </div>
		</div>';
		if ($no % 3 == 0 or $no == $r['end']) {
			$wf .= '</div>';
		}
		$no++;
	}
?>