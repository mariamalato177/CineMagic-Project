@extends('layouts.main')

@section('header-title', 'New Screening')

@section('main')
<div class="flex flex-col items-center space-y-6">
    <div class="p-4 sm:p-8 bg-white  shadow sm:rounded-lg w-full max-w-3xl">
        <div class="w-full-xl">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900 ">
                        New Screening
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 0 mb-6">
                        Click on "Save" button to store the information.
                    </p>
                </header>

                <form method="POST" action="{{ route('screenings.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6 space-y-4 max-w-xl">
                        @include('screenings.shared.fields', ['mode' => 'create'])

                        <div id="screening-sessions">
                            <div class="screening-session">
                                <label for="dates[]">Date</label>
                                <input type="date" name="dates[]" required>

                                <label for="times[]">Time</label>
                                <input type="time" name="times[]" required>
                            </div>

                        </div>
                        <br>

                    </div>
                    <div>
                        <button type="button" id="add-session" class="bg-blue-500 text-white px-4 py-1 rounded">
                            Add Another Session
                        </button>
                    </div>
                    <div class="flex mt-6 justify-center">
                        <x-button element="submit" type="dark" text="Save new screenings" class="uppercase"/>
                        <hr>

                    </div>
                </form>
            </section>
        </div>
    </div>
</div>

<script>
document.getElementById('add-session').addEventListener('click', function() {
    const sessionDiv = document.createElement('div');
    sessionDiv.classList.add('screening-session');

    const dateLabel = document.createElement('label');
    dateLabel.textContent = 'Date';
    sessionDiv.appendChild(dateLabel);

    const dateInput = document.createElement('input');
    dateInput.type = 'date';
    dateInput.name = 'dates[]';
    dateInput.required = true;
    sessionDiv.appendChild(dateInput);

    const timeLabel = document.createElement('label');
    timeLabel.textContent = 'Time';
    sessionDiv.appendChild(timeLabel);

    const timeInput = document.createElement('input');
    timeInput.type = 'time';
    timeInput.name = 'times[]';
    timeInput.required = true;
    sessionDiv.appendChild(timeInput);

    document.getElementById('screening-sessions').appendChild(sessionDiv);
});
</script>
@endsection
