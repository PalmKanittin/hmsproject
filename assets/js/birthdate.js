document.getElementById("birthdate").addEventListener("change", function() {
    var selectedDate = new Date(this.value);
    var currentDate = new Date();

    // ตรวจสอบว่าวันที่ที่ผู้ใช้เลือกอยู่หรือป้อนเข้ามาเป็นวันที่ที่ยังไม่ถึงหรือไม่
    if (selectedDate > currentDate) {
        document.getElementById("dateError").innerHTML = "Please select a valid birthdate.";
        this.value = '';
    } else {
        document.getElementById("dateError").innerHTML = '';
        this.setCustomValidity("");
    }
});