 <section class="content">
     <div class="row clearfix">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="box">
                 <div class="box-header with-border">
                     <h2><?= ucfirst($page_title) ?></h2>
                 </div>
                 <div class="box-tools pull-right">
                     <?php echo anchor(site_url('member/tambah'), 'Tambah Data', 'id="tambah" class="btn btn-primary btn btn-xs"'); ?>
                     <?php echo anchor(site_url('member/excel'), '<i class=\'fa fa-file-excel-o\'></i>Excel', 'class="btn btn-info  btn btn-xs"'); ?>
                     <?php echo anchor(site_url('member/word'), '<i class=\'fa fa-file-word-o\'></i>Word', 'class="btn btn-warning  btn btn-xs"'); ?>
                 </div>
                 <div class="box-body">
                     <div class='row'>
                         <div class='col-sm-12'>
                             <?= $this->session->flashdata('message') ?>
                             <div id="show_form"></div>
                             <div class='white-box'>
                                 <h3 class='box-title m-b-0'></h3>
                                 <table class="table" id="datatables">
                                     <thead>
                                         <tr>
                                             <th width="80px">No</th>
                                             <th>Kode</th>
                                             <th>Nama</th>
                                             <th>Alamat</th>
                                             <th>Ttl</th>
                                             <th>Kelamin</th>
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

                                         var t = $("#datatables").DataTable({
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
                                                 "url": "<?= base_url('member/json') ?>",
                                                 "type": "POST"
                                             },
                                             columns: [{
                                                     "data": "id",
                                                     "orderable": false
                                                 }, {
                                                     "data": "kode"
                                                 }, {
                                                     "data": "nama"
                                                 }, {
                                                     "data": "alamat"
                                                 }, {
                                                     "data": "ttl"
                                                 }, {
                                                     "data": "jk"
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
                                                 window.location.href = '<?= base_url('member/hapus/') ?>' + n;
                                             }
                                         })
                                     }
                                 </script>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>
         </div>

         <script>
             $(function() {
                 $('#tambah').on('click', function(e) {
                     e.preventDefault();
                     $('#show_form').load('<?= base_url('member/tambah') ?>').slideDown();
                 });
             });
             $(function() {
                 $('#datatables').on('click', '#edit', function(e) {
                     e.preventDefault();
                     var load = $(this).attr('load');
                     $('#show_form').load(load).slideDown();
                 });
             });
         </script>