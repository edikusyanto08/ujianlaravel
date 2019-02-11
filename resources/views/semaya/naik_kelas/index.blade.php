@extends('semaya.layouts.app')

@section('content')

<!-- Start breadcrumb content -->
    <div class="card-panel">
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <h4 class="page-title">Pengaturan Naik Kelas</h4>
        </div>
      </div>
      <div class="row mar-bot">
        <div class="col s12 m12 l12">
          <ul class="custom-breadcrumb">
            <li>Naik Kelas</li>
          </ul>
        </div>
      </div>
    </div>
<!-- End breadcrumb content -->

<!-- Start content of page -->
<div class="row">
  <div class="col s12 m12 l12 child-content">
    @if (session('message'))
      <div class="card-panel teal white-text">
        {{ session('message') }}
      </div>
    @endif
    @if ($errors->any())
      <div class="card-panel red white-text">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif
    <div class="card-panel">
      <form action="{{ route('naik_kelas_process') }}" method="post">
        <div class="row">
          <div class="col s12 m12 l6">
            <span class="naik-kelas-text">Dari Kelas</span>
            <select name="dari_kelas" class="select2">
              <option value selected disabled>Pilih Kelas</option>
              @foreach($kelas as $value)
              <option value="{{ $value->id }}">{{ $value->nama_kelas }}</option>
              @endforeach
            </select>
          </div>
          <div class="col s12 m12 l6">
            <span class="naik-kelas-text">Naik ke Kelas</span>
            <select name="ke_kelas" class="select2">
              <option value selected disabled>Pilih Kelas</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m12 l12">
            <table class="striped">
              <thead>
                <th>No.</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>NIS</th>
                <th><input type="checkbox" name="select_all" id="select_all" class="filled-in"><label for="select_all"></label></th>
              </thead>
              <tbody> 
              </tbody>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col s12 m12 l12">
            <button type="submit" class="btn indigo waves-effect waves-light">Proses</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End content of page -->

@endsection

@section('asset_footer')

<script type="text/javascript">
	$(document).ready(function() {
    $('#select_all').on('click', function() {
      $('.addition-check').not(this).prop('checked', this.checked);
    });

		$('select[name=dari_kelas]').on('change', function() {
			let _this = $(this);
			let uri = '{{ route('ajax_get_siswa', ['idkel' => 'dummy']) }}';
			let tBody = $('table').find('tbody');
			let keKelas = $('select[name=ke_kelas]');

      $('#select_all').prop('checked', false);

			tBody.empty();
      keKelas.val('');
      keKelas.find('.current-kelas').remove();

			$.ajax({
				url: uri.replace('dummy',_this.val()),
				type: 'get',
				dataType: 'json',
				success: function(data) {
					let success = data.success;

					if (success == 1) {
						let no = 0;
						let siswa = data.siswa;
						let kelas = data.kelas;

            if (siswa.length > 0) {
              for (let data_siswa of siswa) {
                no++;
                tr = $('<tr>');
                tdNo = $('<td>');
                tdName = $('<td>');
                tdClass = $('<td>');
                tdNIS = $('<td>');
                tdPilih = $('<td>');

                checkBox = $('<input>');
                checkBox.attr('type', 'checkbox');
                checkBox.addClass('filled-in');        
                checkBox.addClass('addition-check');        
                checkBox.attr('name', 'check_' + data_siswa.siswa_id);
                checkBox.attr('id', 'check_' + data_siswa.siswa_id);

                checkBoxLabel = $('<label>');
                checkBoxLabel.attr('for', 'check_' + data_siswa.siswa_id);

                tdNo.text(no + '.');
                tdName.text(data_siswa.nama);
                tdClass.text(data_siswa.kelas);
                tdNIS.text(data_siswa.nis);
                tr.append(tdNo);
                tr.append(tdName);
                tr.append(tdClass);
                tr.append(tdNIS);
                tr.append(tdPilih);
                tdPilih.append(checkBox);
                tdPilih.append(checkBoxLabel);

                tBody.append(tr);
              }
            }

            if (kelas.length > 0) {
              for (let data_kelas of kelas) {
    						keKelasSelect = $('<option>');
    						keKelasSelect.addClass('current-kelas');
    						keKelasSelect.attr('value', data_kelas.id);
    						keKelasSelect.text(data_kelas.nama_kelas);
    						keKelas.append(keKelasSelect);
              }
            }
            else {
              keKelasSelect = $('<option>');
              keKelasSelect.addClass('current-kelas');
              keKelasSelect.attr('value', '0');
              keKelasSelect.text('LULUS');
              keKelas.append(keKelasSelect);
            }
					}
				},
				error:function() {

				}
			})
		});
	});
</script>

@endsection