@extends('crud.modal')
@section('input-form')
<div class="form-group">
    <div class="form-line">
        <label for="name">Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="theme">Tema</label>
        <input type="text" name="theme" class="form-control" required>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="description">Deskripsi</label>
        <textarea name="description" class="form-control desc" required></textarea>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label class="control-label ">Tanggal Kegiatan</label>
        <div class="input-group">
            <input type="text" name="contest_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
            <div class="input-group-append">
                <span class="input-group-text"><i class="ti-calendar"></i></span>
            </div>
        </div><!-- input-group -->
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="number">Poster (Ukuran Kotak Maks. 2MB)</label>
        <input type="file" name="file" class="form-control">
    </div>
</div>





{{-- <div class="form-group">
    <div class="form-line">
        <label class="control-label col-sm-4">Registrasi (Buka - Tutup)</label>

        <div class="input-daterange input-group" id="date-range">
            <input type="text" class="form-control" name="start" />
            <input type="text" class="form-control" name="end" />
        </div>

    </div>

</div> --}}
{{-- <div class="form-group">
    <div class="form-line">
        <label for="number">Gambar Produk</label>
        <input type="text" name="theme" class="form-control">
    </div>
</div> --}}

{{-- <div class="form-group">
   <label for="type">Pilih Salah Satu</label>
   <select class="form-control show-tick" name="type_id" id="typeID" required>
      <option disabled selected value>---- Pilih Salah Satu ----</option>
@foreach($type as $item)
      <option value="{!! $item->id !!}">{!! $item->name !!}</option>
@endforeach
   </select>
</div> --}}

@endsection
