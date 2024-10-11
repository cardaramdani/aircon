@extends('layouts.crud')
@section('title')
      Update Logsheet Amr
@endsection
@section('main-container')

       <h1 align="center" class="my-5">Form Edit Data Role Preset</h1>
<table class="table table-bordered table-striped table-sm">
  <thead class="fixed-header thead-dark" align="center">
<tr>
    <th scope="col" align="center" >Teknisi Shift</th>
    <th scope="col" align="center">CosP</th>
    <th scope="col" align="center">Lwbp</th>
    <th scope="col" align="center">Wbp</th>
    <th scope="col" align="center">KvarH</th>
    <th scope="col" align="center">Penalty</th>
  
</tr>
  </thead>

<tbody>
    <form method="post" action="/amr/edit/{{$amr->id}}">
      @method('patch')
      @csrf
<input type="hidden" name="namateknisi" value="{{$amr->namateknisi}}">
 
<td scope="col" align="center" class="was-validated">  
      <div class="form-group">
      <select class="custom-select"  name="shift"  required>
      <option value="{{$amr->shift}}">{{$amr->shift}}</option>
      <option value="Pagi" >Pagi</option>
      <option value="Siang">Siang</option>
      <option value="Malam">Malam</option>
      </select>
      <div class="invalid-feedback">input data sesuai aktual</div>
  </div>
 </td>

<td scope="col" align="center" class="was-validated">
    <div class="form-group">
     <input type="text" class="form-control"  placeholder="cosp" name="cosp" value="{{$amr->cosp}}" required autocomplete="off" >
      </select>
      <div class="invalid-feedback">input data sesuai aktual</div>
    </div>
</td>
<td scope="col" align="center" class="was-validated">
    <div class="form-group">
     <input type="number" class="form-control" placeholder="lwbp" name="lwbp" value="{{$amr->lwbp}}" required autocomplete="off">
      </select>
      <div class="invalid-feedback">input data sesuai aktual</div>
    </div>
</td>
<td scope="col" align="center" class="was-validated">
    <div class="form-group">
     <input type="number" class="form-control" placeholder="wbp" name="wbp" value="{{$amr->wbp}}" required autocomplete="off">
      </select>
      <div class="invalid-feedback">input data sesuai aktual</div>
    </div>
</td>
<td scope="col" align="center" class="was-validated">
    <div class="form-group">
     <input type="number" class="form-control" placeholder="kvarh" name="kvarh" value="{{$amr->kvarh}}" required autocomplete="off">
      </select>
      <div class="invalid-feedback">input data sesuai aktual</div>
    </div>
</td>
<td scope="col" align="center" class="was-validated">
    <div class="form-group">
     <input type="number" class="form-control" placeholder="penalty" name="penalty" value="{{$amr->penalty}}" required autocomplete="off">
      </select>
      <div class="invalid-feedback">input data sesuai aktual</div>
    </div>
</td>

<button class="btn-lg btn-primary col-md-12 fixed-bottom font-weight-bold"  type="submit">Update</button>

  </form>
  </tbody>
@endsection

