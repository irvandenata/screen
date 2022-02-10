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
        <label class="control-label">Registrasi (Buka - Tutup)</label>

        <div class="input-daterange input-group" id="date-range">
            <input type="text" class="form-control" name="start_regist" />
            <input type="text" class="form-control" name="end_regist" />
        </div>

    </div>

</div>
<div class="form-group">
    <div class="form-line">
        <label for="number">Poster (Ukuran Kotak Maks. 2MB)</label>
        <input type="file" accept="image/*" name="file" class="form-control">
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="number">Role Book</label>
        <input type="file" accept="application/pdf" name="rolebook" class="form-control">
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
