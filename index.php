<?php Include('koneksi-lama.php') ?>;
<!DOCTYPE html>

<html>
	<head>
		<title>Aplikasi Algoritma FP-Growth</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<script type="text/javascript" src="jquery/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>		
		<center> <h1>Aplikasi Algoritma FP-Growth </h1> </center>
		<h3>Masukan Nilai Minimum Support dan Minimum Confidence Terlebih Dahulu!</h3>
		<p>
		<br/>
		<form name="form1" id="form1" method="post">
			Minimum Support = 
			<select name="opt1" id="opt1">
				<option value="" disabled>Pilih</option>
				<option value="0.3"> 30%</option>
				<option value="0.55">55%</option>
				<option value="0.65">65%</option>
			</select>&nbsp;&nbsp;&nbsp;
							
			Minimum Confidence =  
			<select name="opt2" id="opt2">
				<option value="" disabled>Pilih</option>
				<option value="0.8">80%</option>
				<option value="0.85">85%</option>
				<option value="0.9">90%</option>
			</select>&nbsp;&nbsp;&nbsp;
			<input type="submit" name='SubmitForm1' value="Submit">
		</form>
		</p>
					
		<br />
		<br />
					
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#DataTransaksi">
		Data Transaksi
		</button>
	<!-- Modal -->
		<div class="modal fade" id="DataTransaksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog  modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Data Transaksi</h4>
						</div>
						<div class="modal-body">
							<?php
							//menampilkan data transaksi 
							$query1 = mysql_query("SELECT DISTINCT(tid) FROM transaksi");
							while($row_awal1 = mysql_fetch_array($query1))
							{
								$ulangtid = $row_awal1['tid'];
								 echo $ulangtid.". ";
								$queryan = mysql_query("SELECT*FROM transaksi where tid='$ulangtid'");
								while($rowan = mysql_fetch_array($queryan))
								{
									echo $rowan['jenis_barang'].",";
								}
									echo "<br/>";
							}
							?>	
							<?php
								$jml = mysql_result(mysql_query("SELECT COUNT(DISTINCT tid) as jumlah from transaksi"),0); 
							?>
								Jumlah Transaksi = <?php echo $jml; ?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Keterangan">
				Keterangan
			</button>
			<div class="modal fade" id="Keterangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog  modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Keterangan</h4>
						</div>
						<div class="modal-body">
							<table border='1' class="table table-striped">
							<thead>
								<th>KODE</th>
								<th>KETERANGAN</th>
								</thead>
								<tbody>
								<?php //keterangan
									$query3 =mysql_query("SELECT * FROM keterangan");
								?>
								<?php 
									while($row2=mysql_fetch_array($query3)){
								?>
								<tr>
									<td><?php echo $row2['id_item'];?></td>
									<td><?php echo $row2['keterangan'];?></td>
								</tr>
								<?php } ?>
							</tbody>
							</table>			
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>																		
			
			<?php mysql_query("DELETE FROM flist_temp"); ?>
			<?php if(isset($_POST['SubmitForm1'])) { ?>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#HeaderFlist">
				Header Atau F-List
			</button>
			<div class="modal fade" id="HeaderFlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog  modal-sm" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Header Atau F-list</h4>
						</div>
						<div class="modal-body">
							<table border="1" class="table table-striped">
								<th>ID ITEM<th>N(A)
									<?php
										$minsup = $_POST['opt1'];
										$header = $minsup*$jml;
										$query4 = mysql_query("SELECT DISTINCT(id_item) FROM transaksi");
										$query4count = mysql_result(mysql_query("SELECT COUNT(DISTINCT id_item) FROM transaksi "),0);
										$hasil = "";
										
										for($i = 1;$i<=$query4count;$i++)
										{
											$row3 = mysql_fetch_array($query4);
											$idit = $row3['id_item'];
											$hitungjmlidit = mysql_result(mysql_query("SELECT COUNT(id_item) FROM transaksi WHERE id_item = '$idit' "),0);
											if($hitungjmlidit >= $header)
											{
												mysql_query("INSERT INTO flist_temp (id_flist,hasil_flist,na) VALUES ('1','$idit','$hitungjmlidit') ");
												echo "<tr>";
												echo "<td>".$row3['id_item']."</td>";
												echo "<td>".$hitungjmlidit."</td>";
												echo "</tr>";
											}
										}
									?>
								</tr>
							</table>			
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php
			
				mysql_query("DELETE FROM bench_lift"); 
				mysql_query("DELETE FROM hasil_temp");
			?>
			<?php if(isset($_POST['SubmitForm1'])) { ?>
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#SupportConfidence">
				Support dan Confidence
			</button>
			<div class="modal fade" id="SupportConfidence" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog  modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">HASIL NILAI SUPPORT DAN CONFIDENCE</h4>
						</div>
						<div class="modal-body">
							<table border='1' class="table table-striped"> 
											<thead>
												<th>RULE</th>
												<th>COUNT</th>
												<th>SUPPORT</th>
												<th>CONFIDENCE</th>
											</thead>
											<tbody>
											<?php
											$kondisi_temp = mysql_query("SELECT hasil_flist FROM flist_temp WHERE id_flist = 1");
											$k_iditem = array("1","2","3","4","5","13");
											$inputconf = $_POST['opt2'];
											//function ngurutin data query 
											function urut($data){
											if($data){
												$data = explode(",", $data);
												sort($data);
												$hasil = "";
												foreach($data as $r => $d)
													{
														if($r != (count($data) -1)) $hasil .= "$d,";
														else $hasil .= "$d";
													}
														return $hasil;
												}
												return 0;
											}
											
											//jadiin array data query
											$row = array();
											while($data = mysql_fetch_array($kondisi_temp)){
												$row[] = urut($data[0]);
											}
											
											//badingin hasil query dengan k_idiitem
											foreach($k_iditem as $a => $b){
												foreach($row as $k)
											
											if($k == $b) $d[] = $a;
											}
											
											//kondisi atau rule
											if(in_array(0,$d) && in_array(3,$d) && in_array(4,$d))
											{
												$kondisi_count_transaksi = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM(SELECT SUM(IF(id_item=5 OR id_item=4 OR id_item=1,1,0)) AS n FROM transaksi GROUP BY tid) a WHERE a.n=3"),0);
												$sqla = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM(SELECT SUM(IF(id_item=4 OR id_item=1,1,0)) AS n FROM transaksi GROUP BY tid) a WHERE a.n=2"),0);
												$support = ($sqla/$jml)*100;
												$itemconsequent = mysql_result(mysql_query("SELECT COUNT(*) as jml FROM transaksi WHERE id_item = 5"),0);
												$confidence = (($kondisi_count_transaksi/$sqla)*100)/100;
												$confidence = number_format($confidence,2);
												$item = "Oli Mesin Matic & Saringan Udara => Oli Garden";
												$benchmark = $itemconsequent/$jml;
												$liftratio = $confidence/$benchmark;
												$liftratio = number_format($liftratio,2);
												$spesifikasi = "Jika memilih item Oli Mesin Matic dan Saringan Udara maka akan memilih Oli Garden";
												echo "<tr>";
												echo "<td>Rule 1 & 4 => 5</td>";
												echo "<td>".$kondisi_count_transaksi."</td>";
												echo "<td>".$support."</td>";
												echo "<td>";
												if($confidence >= $inputconf) { echo $confidence; }
												echo "</td>";
												echo "</tr>";
												mysql_query("INSERT INTO bench_lift(item,count,support,confidence,itemconsequent,benchmark,liftratio) VALUES ('$item','$kondisi_count_transaksi','$support','$confidence','$itemconsequent','$benchmark','$liftratio')");
												mysql_query("INSERT INTO hasil_temp(spesifikasi,liftratio) VALUES ('$spesifikasi','$liftratio')");
											}
											if(in_array(0,$d) && in_array(3,$d) && in_array(1,$d))
											{
												$kondisi_count_transaksi = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM(SELECT SUM(IF(id_item=4 OR id_item=2 OR id_item=1,1,0)) AS n FROM transaksi GROUP BY tid) a WHERE a.n=3"),0);
												$sqla = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM(SELECT SUM(IF(id_item=4 OR id_item=1,1,0)) AS n FROM transaksi GROUP BY tid) a WHERE a.n=2"),0);
												$support = ($sqla/$jml)*100;
												$itemconsequent = mysql_result(mysql_query("SELECT COUNT(*) as jml FROM transaksi WHERE id_item = 2"),0);
												$confidence = (($kondisi_count_transaksi/$sqla)*100)/100;
												$confidence = number_format($confidence,2);
												$item = "Oli Mesin Matic & Saringan Udara => Roller";
												$benchmark = $itemconsequent/$jml;
												$liftratio = $confidence/$benchmark;
												$liftratio = number_format($liftratio,2);
												$spesifikasi = "Jika memilih item Oli Mesin Matic dan Saringan Udara maka akan memilih Roller";
												echo "<tr>";
												echo "<td>Rule 1 & 4 => 2</td>";
												echo "<td>".$kondisi_count_transaksi."</td>";
												echo "<td>".$support."</td>";
												echo "<td>";
												if($confidence >= $inputconf) { echo $confidence; }
												echo "</td>";
												echo "</tr>";
												mysql_query("INSERT INTO bench_lift(item,count,support,confidence,itemconsequent,benchmark,liftratio) VALUES ('$item','$kondisi_count_transaksi','$support','$confidence','$itemconsequent','$benchmark','$liftratio')");
												mysql_query("INSERT INTO hasil_temp(spesifikasi,liftratio) VALUES ('$spesifikasi','$liftratio')");
											}
											if(in_array(0,$d) && in_array(1,$d))
											{
												$kondisi_count_transaksi = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM(SELECT SUM(IF(id_item=2 OR id_item=1,1,0)) AS n FROM transaksi GROUP BY tid) a WHERE a.n=2"),0);
												$sqla = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM transaksi WHERE id_item = 1"),0);
												$support = ($sqla/$jml)*100;
												$itemconsequent = mysql_result(mysql_query("SELECT COUNT(*) as jml FROM transaksi WHERE id_item = 2"),0);
												$confidence = (($kondisi_count_transaksi/$sqla)*100)/100;
												$confidence = number_format($confidence,2);
												$item = "Oli Mesin Matic & Oli Garden";
												$benchmark = $itemconsequent/$jml;
												$liftratio = $confidence/$benchmark;
												$liftratio = number_format($liftratio,2);
												$spesifikasi = "Jika memilih item Oli Mesin Matic maka akan memilih Oli Garden";
												echo "<tr>";
												echo "<td>Rule 1 => 2</td>";
												echo "<td>".$kondisi_count_transaksi."</td>";
												echo "<td>".$support."</td>";
												echo "<td>";
												if($confidence >= $inputconf) { echo $confidence; }
												echo "</td>";
												echo "</tr>";
												mysql_query("INSERT INTO bench_lift(item,count,support,confidence,itemconsequent,benchmark,liftratio) VALUES ('$item','$kondisi_count_transaksi','$support','$confidence','$itemconsequent','$benchmark','$liftratio')");
												mysql_query("INSERT INTO hasil_temp(spesifikasi,liftratio) VALUES ('$spesifikasi','$liftratio')");
											}
											if(in_array(5,$d) && in_array(0,$d))
											{
												$kondisi_count_transaksi = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM(SELECT SUM(IF(id_item=13 OR id_item=1,1,0)) AS n FROM transaksi GROUP BY tid) a WHERE a.n=2"),0);
												$sqla = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM transaksi WHERE id_item = 13"),0);
												$support = ($sqla/$jml)*100;
												$itemconsequent = mysql_result(mysql_query("SELECT COUNT(*) as jml FROM transaksi WHERE id_item = 1"),0);
												$confidence = (($kondisi_count_transaksi/$sqla)*100)/100;
												$confidence = number_format($confidence,2);
												$item = "Kampas Rem & Oli Mesin Matic";
												$benchmark = $itemconsequent/$jml;
												$liftratio = $confidence/$benchmark;
												$liftratio = number_format($liftratio,2);
												$spesifikasi = "Jika memilih item Kampas Rem maka akan memilih Oli Mesin Matic";
												echo "<tr>";
												echo "<td>Rule 13 => 1</td>";
												echo "<td>".$kondisi_count_transaksi."</td>";
												echo "<td>".$support."</td>";
												echo "<td>";
												if($confidence >= $inputconf) { echo $confidence; }
												echo "</td>";
												echo "</tr>";
												mysql_query("INSERT INTO bench_lift(item,count,support,confidence,itemconsequent,benchmark,liftratio) VALUES ('$item','$kondisi_count_transaksi','$support','$confidence','$itemconsequent','$benchmark','$liftratio')");
												mysql_query("INSERT INTO hasil_temp(spesifikasi,liftratio) VALUES ('$spesifikasi','$liftratio')");
											}
											if(in_array(4,$d) && in_array(0,$d))
											{
												$kondisi_count_transaksi = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM(SELECT SUM(IF(id_item=5 OR id_item=1,1,0)) AS n FROM transaksi GROUP BY tid) a WHERE a.n=2"),0);
												$sqla = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM transaksi WHERE id_item = 5"),0);
												$support = ($sqla/$jml)*100;
												$itemconsequent = mysql_result(mysql_query("SELECT COUNT(*) as jml FROM transaksi WHERE id_item = 1"),0);
												$confidence = (($kondisi_count_transaksi/$sqla)*100)/100;
												$confidence = number_format($confidence,2);
												$item = "Roller & Oli Mesin Matic";
												$benchmark = $itemconsequent/$jml;
												$liftratio = $confidence/$benchmark;
												$liftratio = number_format($liftratio,2);
												$spesifikasi = "Jika memilih item Roller maka akan memilih Oli Mesin Matic";
												echo "<tr>";
												echo "<td>Rule 5 => 1</td>";
												echo "<td>".$kondisi_count_transaksi."</td>";
												echo "<td>".$support."</td>";
												echo "<td>";
												if($confidence >= $inputconf) { echo $confidence; }
												echo "</td>";
												echo "</tr>";
												mysql_query("INSERT INTO bench_lift(item,count,support,confidence,itemconsequent,benchmark,liftratio) VALUES ('$item','$kondisi_count_transaksi','$support','$confidence','$itemconsequent','$benchmark','$liftratio')");
												mysql_query("INSERT INTO hasil_temp(spesifikasi,liftratio) VALUES ('$spesifikasi','$liftratio')");
											}
											if(in_array(2,$d) && in_array(0,$d))
											{
												$kondisi_count_transaksi = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM(SELECT SUM(IF(id_item=3 OR id_item=1,1,0)) AS n FROM transaksi GROUP BY tid) a WHERE a.n=2"),0);
												$sqla = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM transaksi where id_item = 3"),0);
												$support = ($sqla/$jml)*100;
												$itemconsequent = mysql_result(mysql_query("SELECT COUNT(*) as jml FROM transaksi WHERE id_item = 1"),0);
												$confidence = (($kondisi_count_transaksi/$sqla)*100)/100;
												$confidence = number_format($confidence,2);
												$item = "Oli Mesin & Oli Mesin Matic";
												$benchmark = $itemconsequent/$jml;
												$liftratio = $confidence/$benchmark;
												$liftratio = number_format($liftratio,2);
												$spesifikasi = "Jika memilih item Oli Mesin maka akan memilih Oli Mesin Matic";
												echo "<tr>";
												echo "<td>Rule 3 => 1</td>";
												echo "<td>".$kondisi_count_transaksi."</td>";
												echo "<td>".$support."</td>";
												echo "<td>";
												if($confidence >= $inputconf) { echo $confidence; }
												echo "</td>";
												echo "</tr>";
												mysql_query("INSERT INTO bench_lift(item,count,support,confidence,itemconsequent,benchmark,liftratio) VALUES ('$item','$kondisi_count_transaksi','$support','$confidence','$itemconsequent','$benchmark','$liftratio')");
												mysql_query("INSERT INTO hasil_temp(spesifikasi,liftratio) VALUES ('$spesifikasi','$liftratio')");
											}
											if(in_array(3,$d) && in_array(0,$d))
											{
												$kondisi_count_transaksi = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM(SELECT SUM(IF(id_item=4 OR id_item=1,1,0)) AS n FROM transaksi GROUP BY tid) a WHERE a.n=2"),0);
												$sqla = mysql_result(mysql_query("SELECT COUNT(*) AS jml FROM transaksi WHERE id_item = 4"),0);
												$support = ($sqla/$jml)*100;
												$itemconsequent = mysql_result(mysql_query("SELECT COUNT(*) as jml FROM transaksi WHERE id_item = 1"),0);
												$confidence = (($kondisi_count_transaksi/$sqla)*100)/100;
												$confidence = number_format($confidence,2);
												$item = "Saringan Udara & Oli Mesin Matic";
												$benchmark = $itemconsequent/$jml;
												$liftratio = $confidence/$benchmark;
												$liftratio = number_format($liftratio,2);
												$spesifikasi = "Jika memilih item Saringan Udara maka akan memilih Oli Mesin Matic";
												echo "<tr>";
												echo "<td>Rule 4 => 1</td>";
												echo "<td>".$kondisi_count_transaksi."</td>";
												echo "<td>".$support."</td>";
												echo "<td>";
												if($confidence >= $inputconf) { echo $confidence; }
												echo "</td>";
												echo "</tr>";
												mysql_query("INSERT INTO bench_lift(item,count,support,confidence,itemconsequent,benchmark,liftratio) VALUES ('$item','$kondisi_count_transaksi','$support','$confidence','$itemconsequent','$benchmark','$liftratio')");
												mysql_query("INSERT INTO hasil_temp(spesifikasi,liftratio) VALUES ('$spesifikasi','$liftratio')");
											}
									?>
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>		
	
			<?php if(isset($_POST['SubmitForm1'])) { ?>
			<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#BenchmarkLiftRatio">
			Benchmark dan Lift Ratio
			</button>
			<div class="modal fade" id="BenchmarkLiftRatio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog  modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">NILAI BENCHMARK DAN LIFT RATIO</h4>
						</div>
						<div class="modal-body">
						<table border='1' class="table table-striped"> 
											<thead>
												<th>ITEM</th>
												<th>COUNT</th>
												<th>SUPPORT</th>
												<th>CONFIDENCE</th>
												<th>Frekuensi Item Consequent</th>
												<th>BENCHMARK</th>
												<th>LIFTRATIO</th>
											</thead>
											<tbody>
													
												<?php
														$querybenchlift = mysql_query("SELECT*FROM bench_lift");
														while($row = mysql_fetch_array($querybenchlift))
														{
															echo "<tr>";
															echo "<td>".$row['item']."</td>";
															echo "<td>".$row['count']."</td>";
															echo "<td>".$row['support']."</td>";
															echo "<td>";
															if($row['confidence'] >= $inputconf) { echo $row['confidence']; }
															echo "</td>";
															echo "<td>".$row['itemconsequent']."</td>";
															echo "<td>".$row['benchmark']."</td>";
															echo "<td>".$row['liftratio']."</td>";
															echo "</tr>";
														}
													?>
											</tbody>
										</table>							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>				
			
			<?php if(isset($_POST['SubmitForm1'])) { ?>
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Hasil">
			Hasil
			</button>
			<div class="modal fade" id="Hasil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog  modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">SPESIFIKASI SPARE PART YANG BANYAK DIMINATI</h4>
						</div>
						<div class="modal-body">
							<table border='1' class="table table-striped"> 
											<thead>
												<th>SPESIFIKASI</th>
												<th>LIFTRATIO</th>
											</thead>
											<tbody>
													
												<?php
														$queryhasil = mysql_query("SELECT*FROM hasil_temp");
														while($rowhasil = mysql_fetch_array($queryhasil))
														{
															echo "<tr>";
															echo "<td>".$rowhasil['spesifikasi']."</td>";
															echo "<td>".$rowhasil['liftratio']."</td>";
															echo "</tr>";
														}
													?>
											</tbody>
										</table>						
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			
		</body>
	</html>