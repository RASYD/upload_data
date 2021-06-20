<?php 
include "config/connection.php";
include "library/controller.php";
$req = "?menu=pasok";
$tabel="buku";
$tabeldis = "distributor";
@$id_buku = $_GET['id'];
@$id_pasok = $_POST['id_pasok'];
@$id_dis = $_POST['id_dis'];
@$jumlah = $_POST['jumlah'];
@$fieldsementara = array('id_buku'=>$_GET['id'],'judul'=>$_POST['judul'],'jumlah'=>$_POST['jumlah'],'total'=>$_POST['total']);
@$where="id_buku = '$_GET[id]'";
@$wheredis="id_dis = '$_GET[id_dis]'";
$date= date('Y-m-d');

$go = new controller();


if(isset($_GET['hapus'])){
  $id_pasok = $_GET['id'];
  $delete=mysqli_query($con,"DELETE FROM pasok WHERE id_pasok ='$id_pasok' ");
  if($delete){
    echo "<script>alert('Berhasil dihapus');document.location.href='$req'</script>";
  }else{
      echo "<script>alert('Gagal dihapus');document.location.href='$req'</script>";
  }
}

?>


<div class="container w-75 mt-3 pt-3 ">
    <div class="text-secondary mt-5 border border-4  rounded py-4 px-2 shadow border-secondary border-start-0 border-end-0">
        <table  id="data" class="data table table-striped table-bordered table-hover py-3 display">
              <thead class="table-dark">
                <tr>
                  <th>ID PASOK</th>
                  <th>ID BUKU</th>
                  <th>ID DISTRIBUTOR</th>
                  <th>JUMLAH PASOK</th>
                  <th>tanggal</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody class="table-light">
              <?php
                    @$sql = mysqli_query($con,"SELECT * FROM pasok");
                    while($data = mysqli_fetch_assoc($sql)){
                  ?>
                  <tr>
                    <td><?php echo $data['id_pasok'] ?></td>
                    <td><?php echo $data['id_buku'] ?></td>
                    <td><?php echo $data['id_dis'] ?></td>
                    <td><?php echo $data['jumlah'] ?></td>
                    <td><?php echo $data['tanggal'] ?></td>
                    <td><a href="?menu=pasok&hapus&id=<?php echo $data['id_pasok']; ?>" onClick="return confirm('Apakah anda yakin ingin menghapus ?')">Hapus</a></td>
                  </tr>
                  <?php } ?> 
              </tbody>

              <tfoot class="table-dark">
                  <tr>
                    <th>ID PASOK</th>
                    <th>ID BUKU</th>
                    <th>ID DISTRIBUTOR</th>
                    <th>JUMLAH PASOK</th>
                    <th>tanggal</th>
                    <th>Aksi</th>
                  </tr>
              </tfoot>
          </table>
      </div>

      
      



      <div class="modal" id="disModal" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="text-secondary mt-5 border border-4  rounded py-4 px-2 shadow border-secondary border-start-0 border-end-0">
                  <table  id="tabelbukum" class="data table table-striped table-bordered border-light table-hover py-3 display">
                    <thead>
                        <tr class="table-dark">
                            <th>Id Distributor</th>
                            <th>Nama Distributr</th>
                            <th>Alamat</th>
                            <th>No telpon</th>
                          </tr>
                    </thead>
                    <tbody class="table-light">
                        <?php 
                            
                            $no = 0;
                            $sql = "SELECT * from distributor";
                            $jalan = mysqli_query($con, $sql);
                            
                              
                              // if ($jalan == "") {
                              //     echo "<tr><td colspan='4'>No Record</td></tr>";
                              
                              // } else{

                              // foreach($jalan as $r){
                              //     $no++
                              // $query=mysqli_fetch_assoc($jalan);
                              while ($r = mysqli_fetch_assoc($jalan)){
                              $no++;
                          ?>
                          <tr>
                              <td><a href="?menu=pasok&pilih&id=<?= $id_buku?>&id_dis=<?= $r['id_dis']?>"><?=  $r['id_dis'] ?></a></td>
                              <td><?=  $r['nama_dis'] ?></td>
                              <td><?=  $r['alamat'] ?></td>
                              <td><?=  $r['telpon_dis'] ?></td>
                          </tr>
                          <?php }  ?>
                    </tbody>
                    <tfoot class="table-dark">
                    <tr class="table-dark">
                            <th>Id Distributor</th>
                            <th>Nama Distributr</th>
                            <th>Alamat</th>
                            <th>No telpon</th>
                          </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal" id="exampleModal" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="text-secondary mt-5 border border-4  rounded py-4 px-2 shadow border-secondary border-start-0 border-end-0">
                  <table  id="tabelbukum" class="data table table-striped table-bordered border-light table-hover py-3 display">
                    <thead>
                        <tr class="table-dark">
                            <th>Id Buku</th>
                            <th>Judul</th>
                            <th>stok</th>
                            <th>Harga Jual</th>
                            <th>DISKON</th>
                          </tr>
                    </thead>
                    <tbody class="table-light">
                        <?php 
                            
                            $no = 0;
                            $sql = "SELECT * from buku WHERE stok != 0";
                            $jalan = mysqli_query($con, $sql);
                            
                              
                              // if ($jalan == "") {
                              //     echo "<tr><td colspan='4'>No Record</td></tr>";
                              
                              // } else{

                              // foreach($jalan as $r){
                              //     $no++
                              // $query=mysqli_fetch_assoc($jalan);
                              while ($r = mysqli_fetch_assoc($jalan)){
                              $no++;
                          ?>
                          <tr>
                              <td><a href="?menu=pasok&pilih&id=<?= $r['id_buku']?>"><?=  $r['id_buku'] ?></a></td>
                              <td><?=  $r['judul'] ?></td>
                              <td><?=  $r['stok'] ?></td>
                              <td><?=  $r['harga_jual'] ?></td>
                              <td><?=  $r['diskon'] ?></td>
                          </tr>
                          <?php }  ?>
                    </tbody>
                    <tfoot class="table-dark">
                    <tr>
                            <th>Id Buku</th>
                            <th>Judul</th>
                            <th>stok</th>
                            <th>Harga Jual</th>
                            <th>DISKON</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      <script>
            var myModal = document.getElementById('myModal')
            var myInput = document.getElementById('myInput')
            myModal.addEventListener('shown.bs.modal', function () {
              myInput.focus()
            })    
        </script>
  </div>