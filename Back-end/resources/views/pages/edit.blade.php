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
        <div class="row  gap-4">
            
            <div class="col-6">
                <div class="col-3">
                    <label for="tax_id">P.IVA <span style="color: red;  font-size: 1.5em;">*</span> :</label>
                    <input type="text" id="tax_id" name="tax_id" value="{{ $teacher->tax_id }}">
                    <span id="taxNo" class="text-danger d-none"></span>
                </div>
                <div class="col-3">
                    <div class="d-flex flex-column">
                        <label for="biography">Biografia <span style="color: red;  font-size: 1.5em;">*</span></label>
                        <textarea name="biography" id="biography">{{ $teacher->biography }}</textarea>
                        <span id="bioNo" class="text-danger d-none"></span>
                    </div>
                </div>
                <div class="col-3">
                
                    <label for="city">Seleziona una città:<span style="color: red; font-size: 1.5em;">*</span></label>
                    <select id="city" name="city" >
                        <option value="{{ $teacher->city }}" selected>{{ $teacher->city }}</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="phone_number">Numero di telefono <span style="color: red;  font-size: 1.5em;">*</span> :</label>
                    <input type="number" id="phone_number" name="phone_number" value="{{ $teacher->phone_number }}">
                    <span id="PhoneNo" class="text-danger d-none"></span>
                </div>
                <div class="col-3">
                    <label for="image_url">Scegli immagine:</label>
                    <input type="file" id="image_url" name="image_url">
                </div>
                <div class="col-3">
                    <label for="motto">Motto:</label>
                    <input type="text" id="motto" name="motto" value="{{ $teacher->motto }}">
                </div>
                <div class="col-3">
                    <label for="cv_url">Carica il tuo CV <span style="color: red;  font-size: 1.5em;">*</span>:</label>
                    <input type="file" id="cv_url" name="cv_url" accept=".pdf">
                </div>
    
                <div class="col-3">
                    <input type="submit" value="Aggiorna Profilo">
                </div>
                <div>
                    <label>Materie:</label><br>
                    @foreach ($subjects as $subject)
                        <input type="checkbox" id="subject{{ $subject->id }}" name="subjects[]" value="{{ $subject->id }}"
                            {{ $teacher->subjects->contains($subject->id) ? 'checked' : '' }}>
                        <label for="subject{{ $subject->id }}">{{ $subject->name }}</label><br>
                    @endforeach
                </div>
            </div>
            <div class="col-4">
                <div class="img_container">
                    <img src="{{ asset('storage/' . $teacher->image_url) }}" alt="">
                </div>


            </div>

            
            <span style="color: red;  font-size: 2em;">* i seguenti campi sono obbligatori</span>
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
