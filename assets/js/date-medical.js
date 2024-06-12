document.getElementById('medicalhistorydate').addEventListener('change', function() {
    var selectedDate = new Date(this.value);
    var currentDate = new Date();
    
    if (selectedDate < currentDate) {
        document.getElementById('dateError').innerHTML = 'Please Select a Future Date and Time.';
        this.value = '';
    } else {
        document.getElementById('dateError').innerHTML = '';
    }
});
