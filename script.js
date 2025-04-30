
$(document).ready(function () {
    $('#location').change(function () {
        var locationID = $(this).val();
        if (locationID) {
            $.ajax({
                url: 'fetch_hotels.php',
                type: 'POST',
                data: { locationID: locationID },
                success: function (response) {
                    $('#hotel').html(response);
                }
            });
        } else {
          $hotelValue=  $('#hotel').html('<option value="">Choose Hotel</option>');
        
        }
    });
    $('#travel').change(function () {
        $('#travelOptions').toggle(this.checked);
    });
    $('#budgetForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'calculate_budget.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                $('#budgetResult').html(response);
                var resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
                resultModal.show();
            }
        });
    });
});

//rooms Selection
$(document).ready(function () {
    $('#room').change(function () {
        var locationID = $(this).val();
        if (locationID) {
            $.ajax({
                url: 'fetch_room.php',
                type: 'POST',
                data: { roomID: roomID },
                success: function (response) {
                    $('#room').html(response);
                }
            });
        } else {
            $('#room').html('<option value="">Choose room</option>');
        }
    });
    $('#travel').change(function () {
        $('#travelOptions').toggle(this.checked);
    });
    $('#budgetForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: 'calculate_budget.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                $('#budgetResult').html(response);
                var resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
                resultModal.show();
            }
        });
    });
});

// Set the minimum check-in date to today's date
const today = new Date().toISOString().split('T')[0];
const checkinInput = document.getElementById('checkin');
const checkoutInput = document.getElementById('checkout');

checkinInput.setAttribute('min', today);

// Update the checkout date's minimum based on the selected check-in date
checkinInput.addEventListener('change', function () {
    const checkinDate = checkinInput.value;
    checkoutInput.setAttribute('min', checkinDate);
});

// Initialize checkout date min value on page load
checkoutInput.setAttribute('min', today);


//Script fot Select Hotel
document.addEventListener("DOMContentLoaded", function () {
// Get the previous dropdown (assuming it's for location)
let locationDropdown = document.getElementById("location");
let hotelLabel = document.getElementById("hotelLabel");

locationDropdown.addEventListener("change", function () {
    let selectedLocation = this.value; // Get selected location value
    
    // Update label based on selected location
    if (selectedLocation) {
        if (selectedLocation==1) { 
        hotelLabel.textContent = " Hotel in  Makkah" ;
        }
         if(selectedLocation==2)
          {
            hotelLabel.textContent = " Hotel in Madina";
        
        }
    } else
     {
        hotelLabel.textContent = "Select Hotel";
    }
});
});

//Room Selection 
$(document).ready(function () {
$(".plus-btn").click(function () {
    let type = $(this).data("type");
    let countSpan = $(".room-count[data-type='" + type + "']");
    let count = parseInt(countSpan.text()) + 1;
    countSpan.text(count);
    updateTotalRooms();
});

$(".minus-btn").click(function () {
    let type = $(this).data("type");
    let countSpan = $(".room-count[data-type='" + type + "']");
    let count = parseInt(countSpan.text());
    if (count > 0) {
        count--;
        countSpan.text(count);
    }
    updateTotalRooms();
});

function updateTotalRooms() {
    let total = 0;
    $(".room-count").each(function () {
        total += parseInt($(this).text());
    });
    $("#totalRooms").text(total);
}

$("#doneButton").click(function () {
    $(".dropdown-toggle").dropdown('hide');
});
});

const plus = document.querySelector(".plus"),
minus = document.querySelector(".minus"),
num = document.querySelector(".num");
let a = 1;
plus.addEventListener("click", ()=>{
a++;
a = (a < 10) ? "0" + a : a;
num.innerText = a;
});
minus.addEventListener("click", ()=>{
if(a > 1){
a--;
a = (a < 10) ? "0" + a : a;
num.innerText = a;
}
});


/*  For Room Drop Down Values */



/*  For Room Drop Down Values */
