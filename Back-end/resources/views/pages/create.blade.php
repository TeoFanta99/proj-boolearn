@extends('layouts.app')
@section('content')
    <h1>IL TUO Profilo</h1>
    {{-- @auth --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-inline">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="FormCreate" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="container">
            <div class="row gutters">
                <div class="col-xl-4 col-lg-3 col-md-12 col-sm-12 col-12 mb-3">
                    <div class="card p-0 h-50">
                        <div class="card-header bg-transparent border-primary text-primary" style="font-weight: bold">FOTO PROFILO
                        </div>
                        <div class="card-body p-0 m-0 d-flex align-items-center justify-content-center">
                            <div class="account-settings">
                                <label for="image_url"></label>
                                <input type="file" class="form-control" id="image_url" name="image_url">
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-8 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-header bg-transparent border-primary text-primary" style="font-weight: bold">DETTAGLI PROFILO
                        </div>
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group"> 
                                        <div class="form-group">
                                            <label for="phone_number">TELEFONO 
                                                <span style="color: red; font-size: 1.5em;">*</span> 
                                            </label>
                                            <input type="number" class="form-control" id="phone_number" name="phone_number">
                                            <span id="PhoneNo"class="text-danger d-none"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="tax_id">P.IVA <span style="color: red;  font-size: 1.5em;">*</span></label>
                                        <input type="text" class="form-control" id="tax_id" name="tax_id">
                                        <span id="taxNo"class="text-danger d-none"></span> 
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="cv_url">CARICA CV <span style="color: red;  font-size: 1.5em;"> *</span></label>
                                        <input type="file" class="form-control" id="cv_url" name="cv_url" accept=".pdf">          
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <div class="d-flex flex-column">
                                            <label for="biography">BIOGRAFIA <span style="color: red;  font-size: 1.5em;">*</span></label>
                                            <textarea name="biography" class="form-control" id="biography"></textarea>
                                            <span id="bioNo"class="text-danger d-none"></span>
                                        </div>      
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group mb-3">
                                        <label class="mb-2">SELEZIONA MATERIE  <span style="color: red; font-size: 1.5em;"> *</span></label>
                                        <br>

                                        @foreach ($subjects as $subject)
                                            <input type="checkbox" class="form-check-input"  id="subject{{ $subject->id }}" name="subjects[]"
                                                value="{{ $subject->id }}">
                                            <label for="subject{{ $subject->id }}">{{ $subject->name }}</label><br>
                                        @endforeach          
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                       <label for="motto">MOTTO</label>
                                       <textarea class="form-control" id="motto" name="motto"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="d-flex justify-content-between mt-4 text-right">
                                         <div style="color: red; font-size: 1em; text-align: left; font-weight:bold; ">* I seguenti campi sono obbligatori</div>
                                        <input type="submit" class="btn btn-primary" value="CREA">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- @endauth --}}
    <script>
        
        document.getElementById("FormCreate").addEventListener("submit", function(event) {
            event.preventDefault();
            var teachers = <?php echo json_encode($teachers); ?>;
            let validation = 0;
            var teacher = <?php echo json_encode($teachers); ?>;
            let taxID = document.getElementById('tax_id').value;
          
            let phone = document.getElementById('phone_number');

            validation += checkTaxID(taxID, teacher); // Non è necessario passare teacher qui
            validation += checkPhone(phone_number);

            if (validation == 2) {
                this.submit();
            }


            function checkPhone(phone) {
                let isUnique = true;

                // Cicla attraverso gli insegnanti
                for (let i = 0; i < teachers.length; i++) {
                    // Controlla se la partita IVA è un duplicato
                    if (phone.value === teachers[i].phone_number) {
                        // La partita IVA è un duplicato
                        isUnique = false;
                        break; // Esci dal ciclo perché hai trovato un duplicato
                    }
                }

                if (!isUnique) {

                    document.getElementById('PhoneNo').classList.remove('d-none');
                    document.getElementById('PhoneNo').innerHTML = 'Il numero di telefono è già inserito!';
                } else {

                    document.getElementById('PhoneNo').classList.add('d-none');

                }
                return isUnique;
            }

            function checkTaxID(taxID, teachers) {
                let isUnique = true;

                // Cicla attraverso gli insegnanti
                for (let i = 0; i < teachers.length; i++) {
                    // Controlla se la partita IVA è un duplicato
                    if (taxID === teachers[i].tax_id) {
                        // La partita IVA è un duplicato
                        isUnique = false;
                        break; // Esci dal ciclo perché hai trovato un duplicato
                    }
                }

                if (!isUnique) {
                    // Mostra un messaggio di errore se la partita IVA è un duplicato
                    document.getElementById('taxNo').classList.remove('d-none');
                    document.getElementById('taxNo').innerHTML = 'La partita IVA inserita è già stata utilizzata!';
                } else {
                    // Nascondi il messaggio di errore se la partita IVA non è un duplicato
                    document.getElementById('taxNo').classList.add('d-none');

                }

                return isUnique;
            }
        });
    </script>
@endsection
