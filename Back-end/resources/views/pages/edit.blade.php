@extends('layouts.app')
@section('content')
    <h1>Modifica Profilo</h1>
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

    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" id="Form_update">

        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

         <div class="container">
            <div class="row gutters">
                <div class="col-xl-4 col-lg-3 col-md-12 col-sm-12 col-12 mb-3">
                    <div class="card p-0 h-20">
                        <div class="card-header bg-transparent border-primary text-primary" style="font-weight: bold">FOTO PROFILO
                        </div>
                        <div class="card-body border-dark p-3 m-0 d-flex flex-row justify-content-center">
                            <div class="account-settings">
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $teacher->image_url) }}" alt="">
                                </div>
                                <div style="text-align: center">
                                    <label for="image_url" class="btn btn-success">MODIFICA FOTO</label>
                                    <input type="file" id="image_url" name="image_url" style="display: none;">
                                </div>
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
                                            <input type="number" class="form-control" id="phone_number" name="phone_number" value="{{ $teacher->phone_number }}"">
                                            <span id="PhoneNo"class="text-danger d-none"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="city">CITTÀ <span style="color: red;  font-size: 1.5em;">*</span></label>
                                            <select id="city" class="form-control" name="city">
                                                <optionvalue="{{ $teacher->city }}" selected>{{ $teacher->city }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="tax_id">P.IVA <span style="color: red;  font-size: 1.5em;">*</span></label>
                                        <input type="text" class="form-control" id="tax_id" name="tax_id" value="{{ $teacher->tax_id }}">
                                        <span id="taxNo"class="text-danger d-none"></span> 
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="cv_url">CARICA CV <span style="color: red;  font-size: 1.5em;"> *</span></label>
                                        <input type="file" class="form-control" id="cv_url" name="cv_url" accept=".pdf">          
                                    </div>
                                    <!-- Imposto un collegamento al pdf del docente -->
                                    <a href="{{URL::to('storage/' . $teacher->cv_url)}}">

                                        <!-- carico logo pdf -->
                                        <img src="{{ Vite::asset('public/storage/images/logo_pdf.jpg') }}" class="logo_pdf" alt="cv teacher">

                                    </a>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <div class="d-flex flex-column">
                                            <label for="biography">BIOGRAFIA <span style="color: red;  font-size: 1.5em;">*</span></label>
                                            <textarea name="biography" class="form-control" id="biography">{{ $teacher->biography }}</textarea>
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
                                                value="{{ $subject->id }}" {{ $teacher->subjects->contains($subject->id) ? 'checked' : '' }}>
                                            <label for="subject{{ $subject->id }}">{{ $subject->name }}</label><br>
                                        @endforeach          
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                       <label for="motto">MOTTO</label>
                                       <textarea class="form-control" id="motto" name="motto">{{ $teacher->motto }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="d-flex justify-content-between mt-4 text-right">
                                         <div style="color: red; font-size: 1em; text-align: left; font-weight:bold; ">* I seguenti campi sono obbligatori</div>
                                        <input type="submit" class="btn btn-primary" value="AGGIORNA PROFILO">
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
        document.addEventListener("DOMContentLoaded", function() {
            getCities();

            function populateCitySelect(cities) {
                const select = document.getElementById("city");
                cities.forEach(city => {
                    const option = document.createElement("option");
                    option.value = city.nome;
                    option.textContent = city.nome;
                    select.appendChild(option);
                });
            }

            function getCities() {
                fetch('https://axqvoqvbfjpaamphztgd.functions.supabase.co/comuni')
                    .then(response => response.json())
                    .then(data => {
                        // Controlla se ci sono risultati
                        if (Array.isArray(data) && data.length > 0) {
                            populateCitySelect(data);
                        } else {
                            console.log("Nessuna città trovata.");
                        }
                    })
                    .catch(error => {
                        console.error("Si è verificato un errore:", error);
                    });
            }
        });
        document.getElementById("Form_update").addEventListener("submit", function(event) {
            event.preventDefault();

            let validation = 0;
            var teachers = <?php echo json_encode($teachers); ?>;
            var teacherSingle= <?php echo json_encode($teacher); ?>;
            let taxID = document.getElementById('tax_id').value;
            let bio = document.getElementById('biography').value;
            let phone = document.getElementById('phone_number');

            validation += checkTaxID(taxID, teachers,teacherSingle); // Non è necessario passare teacher qui
            validation += checkBio(bio);
            validation += checkPhone(phone_number,teacherSingle);

            if (validation == 3) {
                this.submit();
            }


            function checkPhone(phone,teacherSingle) {
                let isUnique = true;

                
                for (let i = 0; i < teachers.length; i++) {
                    if(phone.value == teachers[i].phone_number && teachers[i].id ==teacherSingle.id ){
                        break;
                    }
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

            function checkBio(bio) {
                let yesOrNo;
                console.log(bio);
                if (bio.length > 500) {
                    document.getElementById('bioNo').classList.remove('d-none');
                    document.getElementById('bioNo').innerHTML =
                        'La Biografia deve essere massimo di 500 caratteri!';
                } else if (bio.length < 200) {
                    document.getElementById('bioNo').classList.remove('d-none');
                    document.getElementById('bioNo').innerHTML =
                        'La Biografia deve essere almeno di 200 caratteri!';
                } else {
                    document.getElementById('bioNo').classList.add('d-none');
                    yesOrNo = true;
                }
                return yesOrNo;
            }

            function checkTaxID(taxID, teachers,teacher) {
                let isUnique = true;

                // Cicla attraverso gli insegnanti
                for (let i = 0; i < teachers.length; i++) {
                    // Controlla se la partita IVA è un duplicato
                    if(taxID == teacher.tax_id){
                        break;
                    }
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
