<template>
    <div class="meeting-panel">
        <div class="calendar">
            <div class="calendar-header">
                <button class="nav-btn" @click="goToPreviousDay">
                    <i class="fa-solid fa-angle-left" ></i>
                </button>
                <div>
                    <label :class="{ 'radio-label': true, 'selectedOption': selectedOption === 'day' }" >
                        <input type="radio" v-model="selectedOption" value="day">
                        {{transilation('day')}}
                    </label>
                    <label  :class="{ 'radio-label': true, 'selectedOption': selectedOption === 'week' }" >
                        <input type="radio" v-model="selectedOption" value="week">
                        {{transilation('week')}}
                    </label>
                </div>
                <button class="nav-btn" @click="goToNextDay">   
                    <i class="fa-solid fa-angle-right" ></i>
                </button>
            </div>
        </div>
        <div v-if="selectedOption === 'day'" style="display: flex; flex-direction: column;justify-content: center;align-items: center;" class="mb-3">
            <h1 style="margin: 0px;">{{ formatDateToWeekDay(currentDate) }}</h1>
            <h5 style="margin: 0px;">{{  formatDateToDay(currentDate) }}</h5>
        </div>
        <div v-if="filteredDay.active && selectedOption === 'day'">
            <div class="time-section" >
                <h2>{{transilation('am')}} ({{getFirstTimeSlot(filteredDay.hours.filter(h => getAMorPM(h.hour) === 'AM'))}} - {{getLastTimeSlot(filteredDay.hours.filter(h => getAMorPM(h.hour) === 'AM'))}})</h2>
                <div class="time-slots">
                    <div v-for="hour in filteredDay.hours.filter(h => getAMorPM(h.hour) === 'AM')" :key="hour.hour"
                        :class="{ 'time-slot': true,
                            'selected': selectedTime === formatToISOString(hour.hour) ,
                            'Unselectable':isUnselectable(formatToISOString(hour.hour))
                         }"
                        @click="selectTime(formatToISOString(hour.hour),!isUnselectable(formatToISOString(hour.hour)))"
                    >
                    {{ hour.hour }}
                    </div>
                </div>
            </div>
            <div class="time-section">
                <h2>{{transilation('pm')}} ({{getFirstTimeSlot(filteredDay.hours.filter(h => getAMorPM(h.hour) === 'PM'))}} - {{getLastTimeSlot(filteredDay.hours.filter(h => getAMorPM(h.hour) === 'PM'))}})</h2>
                <div class="time-slots">
                    <div class="time-slots">
                    <div v-for="hour in filteredDay.hours.filter(h => getAMorPM(h.hour) === 'PM')" :key="hour.hour"
                        :class="{ 'time-slot': true,
                            'selected': selectedTime === formatToISOString(hour.hour) ,
                            'Unselectable':isUnselectable(formatToISOString(hour.hour)),
                         }"
                        @click="selectTime(formatToISOString(hour.hour),!isUnselectable(formatToISOString(hour.hour)))"
                    >
                    {{ hour.hour }}
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div v-if="!filteredDay.active && selectedOption === 'day'">
            <div class="time-section" >
                <h2>{{transilation('am')}} ({{getFirstTimeSlot(filteredDay.hours.filter(h => getAMorPM(h.hour) === 'AM'))}} - {{getLastTimeSlot(filteredDay.hours.filter(h => getAMorPM(h.hour) === 'AM'))}})</h2>
                <div class="time-slots">
                    <div v-for="hour in filteredDay.hours.filter(h => getAMorPM(h.hour) === 'AM')" :key="hour.hour"
                        class="time-slot Unselectable"
                        @click="inactiveDay"
                    >
                    {{ hour.hour }}
                    </div>
                </div>
            </div>
            <div class="time-section">
                <h2>{{transilation('pm')}} ({{getFirstTimeSlot(filteredDay.hours.filter(h => getAMorPM(h.hour) === 'PM'))}} - {{getLastTimeSlot(filteredDay.hours.filter(h => getAMorPM(h.hour) === 'PM'))}})</h2>
                <div class="time-slots">
                    <div v-for="hour in filteredDay.hours.filter(h => getAMorPM(h.hour) === 'PM')" :key="hour.hour"
                        class="time-slot Unselectable"
                        @click="inactiveDay"
                    >
                    {{ hour.hour }}
                    </div>
                </div>
            </div>
        </div>

        <div v-if="days && selectedOption === 'week'">  
            <div class="calendar-week">
                <div v-for="day in generateWeek" :key="day.id" class="day">
                    <div class="weekday">{{  formatDateToWeekDay(day.dayweek) }}</div>
                    <div class="fullweekday">{{  formatDateToDay(day.dayweek) }}</div>
                    <div class="hours" v-if="!day.filtredDay.active">
                        <div
                            v-for="hour in day.filtredDay.hours"
                            :key="hour.hour"
                            class="hour-btn Unselectable"
                            @click="inactiveDay"

                        >
                            {{ hour.hour }}
                        </div>
                    </div>
                    <div class="hours" v-if="day.filtredDay.active">
                        <div
                            v-for="hour in day.filtredDay.hours"
                            :key="hour.hour"
                            @click="selectTime(formatToISOStringParamter(hour.hour,day.dayweek),!isUnselectable(formatToISOStringParamter(hour.hour,day.dayweek)))"
                            :class="{ 'hour-btn': true,
                             'selected': selectedTime === formatToISOStringParamter(hour.hour,day.dayweek),
                             'Unselectable':isUnselectable(formatToISOStringParamter(hour.hour,day.dayweek)),
                             }"
                        >
                            {{ hour.hour }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="add-to-cart-button">
            <button class="add-to-cart-btn" @click="addToCart">{{transilation('btn')}} <i class="ml-1 fa-solid fa-calendar-check"></i></button>
        </div>
    </div>
  </template>
  
  <script>
  import Swal from 'sweetalert2';
    export default {
        props: {
            days: {
                type: Array,
                required: true,
            },
            meetings: {
                type: Array,
                required: true,
            },
            local: {
                type: String,
                required: true,
            },
            currentdateserver: {
                type: String,
                required: true,
            },

        },
        data() {
            return {
                currentDate: new Date(),
                selectedOption: 'day',
                selectedTime: null,
                cart: [],
            };
        },
        methods: {
            selectTime(timeSlot,status) {
                if (status) {
                    this.selectedTime = timeSlot;
                }else{
                    this.inactiveDay()
                }
                
            },
            formatToISOString(time) {
                const [hours, minutes] = time.split(":");
                const dateObject = this.currentDate;
                dateObject.setHours(Number(hours), Number(minutes), 0, 0);
                return dateObject.toISOString();
            },
            formatToISOStringParamter(time,date) {
                const [hours, minutes] = time.split(":");
                const dateObject = date;
                dateObject.setHours(Number(hours), Number(minutes), 0, 0);
                return dateObject.toISOString();
            },
            formatDateToWeekDay(date) {
                const options = {   weekday: 'long'  };
                switch (this.local) {
                    case 'al':
                        var days = ["E Diel", "E Hënë", "E Martë", "E Mërkurë", "E Enjte", "E Premte", "E Shtunë"];
                        return days[date.getDay()];
                    case 'ar':
                        return date.toLocaleDateString('ar-EG', options);
                    case 'it':
                        return date.toLocaleDateString('it-IT', options);
                    default:
                        return date.toLocaleDateString('en-US', options);
                }
            },
            formatDateToDay(date) {
                const options = {  month: 'long' };

                switch (this.local) {
                    case 'al':
                        var months = ["Janar", "Shkurt", "Mars", "Prill", "Maj", "Qershor", "Korrik", "Gusht", "Shtator", "Tetor", "Nëntor", "Dhjetor"];
                        return date.getDate()+" "+months[date.getMonth()]+ " " + date.getFullYear();
                    case 'ar':
                        return date.toLocaleDateString('ar-EG', {  year: 'numeric', month: 'long', day: 'numeric' });
                    case 'it':
                        return date.getDate()+" "+date.toLocaleDateString('it-IT', options)+ " " + date.getFullYear();
                    default:
                        return date.getDate()+" "+date.toLocaleDateString('en-US', options)+ " " + date.getFullYear();
                }
            },
            goToNextDay() {
                const nextDate = new Date(this.currentDate);
                if(this.selectedOption==="day"){
                    nextDate.setDate(nextDate.getDate() + 1);
                }else{
                    nextDate.setDate(nextDate.getDate() + 7);
                }
                
                this.currentDate = nextDate;
            },
            goToPreviousDay() {
                const previousDate = new Date(this.currentDate);
                if(this.selectedOption==="day"){
                    previousDate.setDate(previousDate.getDate() - 1);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    if (previousDate >= today) {
                        this.currentDate = previousDate;
                    }
                }else{
                    previousDate.setDate(previousDate.getDate() - 7);

                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    if (previousDate >= today) {
                        this.currentDate = previousDate;
                    }else{
                        this.currentDate = new Date();
                    }
                }
                
            },
            getAMorPM(time) {
                const hours = Number(time.split(':')[0]);
                return (hours >= 0 && hours <= 11) ? 'AM' : (hours >= 12 && hours <= 23) ? 'PM' : 'Invalid time';
            },
            getFirstTimeSlot(timeSlots) {
                if (timeSlots.length > 0) {
                    return timeSlots[0].hour;
                }
                return null; // or any other default value
            },
            getLastTimeSlot(timeSlots) {
                if (timeSlots.length > 0) {
                    return timeSlots[timeSlots.length - 1].hour;
                }
                return null; // or any other default value
            },

            isUnselectable(dateParamter) {
                const matchingDate = this.meetings.find(date => date.DateMeeting === dateParamter);

                // Get the current date and time
                const currentDate = new Date(this.currentdateserver);

                // Set the target date and time you want to compare
                const targetDate = new Date(dateParamter); // Example date and time
                // Subtract 30 minutes from targetDate
                const adjustedTargetDate = new Date(targetDate.getTime() - 30 * 60 * 1000);

                // Compare the target date with the current date
                if (adjustedTargetDate > currentDate) {
                    return matchingDate ? true : false;;
                } else {
                    return true;
                }

                
            },

            addToCart() {

                if (!this.selectedTime ) {    
                    Swal.fire('No Meeting Selected', 'Please select a meeting time to add to the cart.', 'warning');
                    return;
                }else{
                    const existingItem = this.cart.find(item => item === this.selectedTime);
                    if (existingItem) {
                        Swal.fire('Existed Meeting', 'This meeting time is already in your cart.', 'info');
                        this.selectedTime=null
                        return;
                    }
                    this.cart.push(this.selectedTime);
                    this.saveCartToCookie();
                    this.selectedTime=null;
                    this.cart = [];
                    window.location.href ='/customer/appointment-details'
                }
            },
            inactiveDay(){
                Swal.fire('reserved Meeting', 'sorry this meeting already reserved .', 'warning');
                    this.selectedTime=null
                    return;
            },
            saveCartToCookie() {
                const expirationDate = new Date();
                expirationDate.setTime(expirationDate.getTime() + 10 * 60 * 1000); // Expires in 1 day
                document.cookie = `cart=${JSON.stringify(this.cart)};expires=${expirationDate.toUTCString()}`;
            },
            transilation(parameter){
                switch (this.local) {
                    case 'al':
                        switch (parameter) {
                            case 'btn':
                                return 'Lini një takim'
                            case 'am' :
                                return 'Periudha e mëngjesit'
                            case 'pm' :
                                return 'Koha e mbrëmjes'
                            case 'day' :
                                return 'ditë'
                            case 'week' :
                                return 'javë'
                            }
                    case 'ar':
                        switch (parameter) {
                            case 'btn':
                                return 'إحجز موعد'
                            case 'am' :
                                return 'فترة الصباح'
                            case 'pm' :
                                return 'فترة المساء'
                            case 'day' :
                                return 'اليوم'
                            case 'week' :
                                return 'أسبوع'
                        }
                    case 'it':
                        switch (parameter) {
                            case 'btn':
                                return 'fissare un appuntamento'
                            case 'am' :
                                return 'periodo mattutino'
                            case 'pm' :
                                return 'periodo serale'
                            case 'day' :
                                return 'giorno'
                            case 'week' :
                                return 'settimana'
                        }
                    default:
                        switch (parameter) {
                            case 'btn':
                                return 'Make an appointement'
                            case 'am' :
                                return 'Morning period'
                            case 'pm' :
                                return 'Evening period'
                            case 'day' :
                                return 'day'
                            case 'week' :
                                return 'week'
                        }
                }
            }

        },
        mounted() {
            // console.log(this.currentdateserver)
        },
        computed: {
            filteredDay() {
                const currentWeekday = this.currentDate.toLocaleString('en-us', { weekday: 'long' }).toLowerCase();

                return this.days.find((day) => day.weekday.toLowerCase() === currentWeekday );
            },
            generateWeek() {
                const weekdays = [];
                for (let i = 0; i < 7; i++) {

                    const dayweek = new Date(this.currentDate);
                    dayweek.setDate(this.currentDate.getDate() + i);
                    const currentWeekday = dayweek.toLocaleString('en-us', { weekday: 'long' }).toLowerCase()
                    const filtredDay=this.days.find((day) => day.weekday.toLowerCase() === currentWeekday );
                    weekdays.push({ dayweek ,filtredDay});
                }
                return weekdays
            },
        },

  };
  </script>
  
  <style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f5f5f5;
}

.meeting-panel {
  max-width: 1000px;
  margin: 50px auto;
  padding: 20px;
  background: #f2f5f7;
  border: 1px solid #ccc;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

.time-section {
  margin-bottom: 30px;
}

h2 {
  text-align: center;
  font-size: 1.2rem;
  margin-bottom: 10px;
  color: #808080;
}

.time-slots {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.time-slot {
    width: 150px;
    height: 50px;
    line-height: 50px;
    text-align: center;
    border-radius: 7px;
    margin: 5px;
    transition: background-color 0.3s ease;
    box-shadow: 1px 1px 2px 0px #ddd;
    background: linear-gradient(180deg, #ffffff, #f9f9f9);
    color: #444;
    cursor: pointer;
}

.time-slot:hover {
  background-color: #f2f2f2;
}

.calendar {
  margin: 10px auto 0px auto;
  padding: 0px 25px;
}

.calendar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.nav-btn {
  color: #949494;
  background-color: transparent;
  font-size: 2rem;
  font-weight: 900;
  padding: 10px 20px;
  cursor: pointer;
}

.nav-btn:hover {
    color: #5cde8e;
}

.date {
  font-size: 1.5rem;
  color: #333;
}

.radio-label {
  display: inline-flex;
  align-items: center;
  cursor: pointer;
  font-size: 14px;
  color: #7b7b7b;
  margin: 0px 5px;
}

.radio-label input[type="radio"] {
  display: none;
}

.selectedOption {
  color: #007BFF;
  padding: 5px 10px;
  border: 2px dashed #007BFF;
  border-radius: 10px;
}

.selected {
    border: 2px dashed #5d4190;
    border-radius: 10px;
    color: #5d4190;
}
.Unselectable{
    border: 2px dashed #823434;
    background: linear-gradient(180deg, #ff65658a, #ff7e7e91);
    /* cursor: not-allowed; */
    -webkit-text-decoration-line: line-through;
    text-decoration-line: line-through; 
    text-decoration-color: rgb(91, 91, 91);
}

.calendar-week {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    margin: 20px auto;
    max-width: 800px;
}

.day {
    flex: 1;
    min-width: 200px;
    background-color: #e2edff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.weekday {
    text-align: center;
    font-size: 1.2rem;
    font-weight: bold;
    padding: 10px 0px 5px 0px;
    background-color: #f1f1f1;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}
.fullweekday {
    text-align: center;
    font-size: .7rem;
    padding: 0px 0px 5px 0px;
    background-color: #f1f1f1;
}

.hours {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    padding: 10px;
}

.hour-btn {
    background-color: #ffffff;
    /* border: 1px solid #d1d1d1; */
    border-radius: 5px;
    padding: 8px 12px;
    font-size: 0.9rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

  .hour-btn:hover {
    background-color: #f3f3f3;
  }
/* Styling for the Add to Cart button */
.add-to-cart-button {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.add-to-cart-btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    border: none;
    border-radius: 7px;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
    background-color: #ffffff;
    color: #ffa206;
    border: 2px solid #f0c36f;
}

.add-to-cart-btn:hover {
    background-color: #ffa206;
    color: #ffffff;
    border: 2px solid #ffa206;
}

/* Responsive styles */
@media screen and (max-width: 768px) {
    .calendar-week {
        flex-direction: column;
        align-items: center;
    }
    .add-to-cart-btn {
        padding: 8px 16px;
        font-size: 14px;
    }
}

  @media screen and (max-width: 600px) {
    .day {
      max-width: 100%;
    }
  }


/* Responsive Styles */
@media screen and (max-width: 768px) {
  .meeting-panel {
    padding: 10px;
  }

  /* .time-slots {
    justify-content: flex-start;
  } */

  .time-slot {
    /* width: 80px; */
    height: 40px;
    line-height: 40px;
  }
}

  </style>
  