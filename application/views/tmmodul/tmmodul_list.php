 <div class="box">
     <div class="box-header with-border">
         <h2><i class="fa fa-list"></i>Data Master Modul Aplikasi</h2>
     </div>
     <div class="box-body">
         <div class='row'>
             <div class='col-sm-12'>
                 <?= $this->session->flashdata('message') ?>
                 <div class='white-box'>
                     <h3 class='box-title m-b-0'></h3>
                     <?php echo anchor(site_url('tmmodul/tambah'), 'Tambah Data', 'class="btn btn-primary btn-xs"'); ?>
                     <?php echo anchor(site_url('tmmodul/excel'), '<i class=\'fa fa-file-excel-o\'></i>Excel', 'class="btn btn-info btn-xs"'); ?>
                     <?php echo anchor(site_url('tmmodul/word'), '<i class=\'fa fa-file-word-o\'></i>Word', 'class="btn btn-danger btn-xs"'); ?>

                     <br /><br />
                     <div class="callout callout-info">
                         <ol>
                             <li>To show about modul in apps , manage privelage login with limit access at user</li>
                         </ol>
                     </div>
                     <table class="table" id="datatables">
                         <thead>
                             <tr>
                                 <th width="80px">No</th>
                                 <th>Modulnm</th>
                                 <th>Url</th>
                                 <th>Params</th>
                                 <th>Active</th>
                                 <th width="200px">Action</th>
                             </tr>
                         </thead>

                     </table>

                     <script type="text/javascript">
                         $(document).ready(function() {
                             $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
                                 return {
                                     "iStart": oSettings._iDisplayStart,
                                     "iEnd": oSettings.fnDisplayEnd(),
                                     "iLength": oSettings._iDisplayLength,
                                     "iTotal": oSettings.fnRecordsTotal(),
                                     "iFilteredTotal": oSettings.fnRecordsDisplay(),
                                     "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                                     "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                                 };
                             };

                             var t = $("#datatables").dataTable({
                                 initComplete: function() {
                                     var api = this.api();
                                     $('#datatables input')
                                         .off('.DT')
                                         .on('keyup.DT', function(e) {
                                             if (e.keyCode == 13) {
                                                 api.search(this.value).draw();
                                             }
                                         });
                                 },
                                 oLanguage: {
                                     sProcessing: "loading..."
                                 },
                                 processing: true,
                                 serverSide: true,
                                 ajax: {
                                     "url": "tmmodul/json",
                                     "type": "POST"
                                 },
                                 columns: [{
                                         "data": "id",
                                         "orderable": false
                                     }, {
                                         "data": "modulnm"
                                     }, {
                                         "data": "url"
                                     }, {
                                         "data": "params"
                                     }, {
                                         "data": "active"
                                     },
                                     {
                                         "data": "action",
                                         "orderable": false,
                                         "className": "text-center"
                                     }
                                 ],
                                 order: [
                                     [0, 'desc']
                                 ],
                                 rowCallback: function(row, data, iDisplayIndex) {
                                     var info = this.fnPagingInfo();
                                     var page = info.iPage;
                                     var length = info.iLength;
                                     var index = page * length + (iDisplayIndex + 1);
                                     $('td:eq(0)', row).html(index);
                                 }
                             });
                         });


                         function hapus(n) {
                             event.preventDefault();
                             Swal.fire({
                                 title: 'Anda akan keluar dari halamn administrator ?',
                                 text: "klik jika iya",
                                 icon: 'warning',
                                 showCancelButton: true,
                                 confirmButtonColor: '#3085d6',
                                 cancelButtonColor: '#d33',
                                 confirmButtonText: 'Ya'
                             }).then((result) => {
                                 if (result.value) {
                                     swal.fire('Hapus Data', 'Data Berhasil Di Hapus', 'success');
                                     window.location.href = '<?= base_url('tmmodul/hapus/') ?>' + n;
                                 }
                             })
                         }
                     </script>
                 </div>
             </div>
         </div>
     </div>
 </div>