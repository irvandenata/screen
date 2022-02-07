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
        <label for="priority">Prioritas</label>
        <input type="number" name="priority" class="form-control" required>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="config_key">Config_key</label>
        <input type="text" name="config_key" class="form-control" required>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="config_value">Config_value</label>
        <input type="text" name="config_value" class="form-control" required>
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
        <label for="additional">Kegunaan</label>
        <textarea name="additional" class="form-control addit" required></textarea>
    </div>
</div>
<div class="form-group">
    <div class="form-line">
        <label for="number">Gambar (Ukuran Kotak Maks. 2MB)</label>
        <input type="file" name="file" class="form-control">
    </div>
</div>


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
