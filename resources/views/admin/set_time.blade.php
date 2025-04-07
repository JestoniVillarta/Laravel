<x-navigation>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Attendance Time</title>
    <!-- Bootstrap CSS -->
   
</head>

<style>
      .time-container {
        width: 95%;
        margin: 0 auto;
        margin-top: 3rem;
        padding: 1.5rem;
        box-sizing: border-box;
    }
</style>

<body >

    <div class="time-container  bg-white rounded shadow-sm mt-4">
        <div class="row justify-content-center">

        <h2 class="h5 mb-0">Time Settings</h2>

            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="fw-bold">Set Attendance Time</h3>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="form-wrapper">
                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                    @endif
                                    
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    
                                    <form action="{{ route('attendance.set-time') }}" method="post">
                                        @csrf
                                        <div class="time-container mb-4">
                                            <div class="text-center mb-4">
                                                <h4 class="badge bg-secondary p-2 fs-5">MORNING</h4>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="morning_time_in" class="col-sm-3 col-form-label">Time In:</label>
                                                <div class="col-sm-4">
                                                    <input type="time" id="morning_time_in" name="morning_time_in" value="{{ old('morning_time_in', $morning_time_in ?? '') }}" required class="form-control">
                                                </div>
                                                <div class="col-sm-1 text-center">
                                                    <span class="fw-bold">—</span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="time" id="morning_time_in_end" name="morning_time_in_end" value="{{ old('morning_time_in_end', $morning_time_in_end ?? '') }}" required class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="morning_time_out" class="col-sm-3 col-form-label">Time Out:</label>
                                                <div class="col-sm-4">
                                                    <input type="time" id="morning_time_out" name="morning_time_out" value="{{ old('morning_time_out', $morning_time_out ?? '') }}" required class="form-control">
                                                </div>
                                                <div class="col-sm-1 text-center">
                                                    <span class="fw-bold">—</span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="time" id="morning_time_out_end" name="morning_time_out_end" value="{{ old('morning_time_out_end', $morning_time_out_end ?? '') }}" required class="form-control">
                                                </div>
                                            </div>

                                            <br>
                                            <br>
                                            
                                            <div class="text-center my-4">
                                                <h4 class="badge bg-secondary p-2 fs-5">AFTERNOON</h4>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="afternoon_time_in" class="col-sm-3 col-form-label">Time In:</label>
                                                <div class="col-sm-4">
                                                    <input type="time" id="afternoon_time_in" name="afternoon_time_in" value="{{ old('afternoon_time_in', $afternoon_time_in ?? '') }}" required class="form-control">
                                                </div>
                                                <div class="col-sm-1 text-center">
                                                    <span class="fw-bold">—</span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="time" id="afternoon_time_in_end" name="afternoon_time_in_end" value="{{ old('afternoon_time_in_end', $afternoon_time_in_end ?? '') }}" required class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="row mb-3">
                                                <label for="afternoon_time_out" class="col-sm-3 col-form-label">Time Out:</label>
                                                <div class="col-sm-4">
                                                    <input type="time" id="afternoon_time_out" name="afternoon_time_out" value="{{ old('afternoon_time_out', $afternoon_time_out ?? '') }}" required class="form-control">
                                                </div>
                                                <div class="col-sm-1 text-center">
                                                    <span class="fw-bold">—</span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="time" id="afternoon_time_out_end" name="afternoon_time_out_end" value="{{ old('afternoon_time_out_end', $afternoon_time_out_end ?? '') }}" required class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="submit" class="btn btn-primary">Set Time</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>
</x-navigation>