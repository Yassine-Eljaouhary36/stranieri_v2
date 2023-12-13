@push('styles')
    <style>
        .country-dropdown-container{
            background-color: white;
            border: 1px solid #ced4da;
            border-radius: 4px;
            z-index: 1051;
            display: none;
            margin-top: 10px;
        }
        .country-dropdown {
            max-height: 120px;
            overflow-y: auto;
        }
        .country-dropdown li{
            padding: 2px 10px
        }
        .country-dropdown li:hover{
            background-color: #6f42c1;
            color: white;
        }
        .country-dropdown::-webkit-scrollbar {
            width: 12px;
        }

        .country-dropdown::-webkit-scrollbar-track {
            background-color: #f1f1f1; 
            border-radius: 6px;
        }

        .country-dropdown::-webkit-scrollbar-thumb {
            background-color: #6f42c1; 
            border-radius: 6px; 
            height: 35px
        }

        .country-dropdown::-webkit-scrollbar-thumb:hover {
            background-color: #555; 
        }

        .select-option{
            position: relative;
        }
        .select-option input{
            width: 100%;
            background-color: #fff;
            color: #000;
            border-radius: .25rem;
            cursor: pointer;
            font-size: 1rem;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            outline: 0 !important;

        }
        .select-option input.is-invalid{
            border-color: #dc3545;
        }
        .select-option:after{
            content: '';
            border-top: 12px solid #6f42c1;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            position: absolute;
            top: 50%;
            margin-top: -8px;
        }
        .select-box.rlt-version .select-option:after{
            left: 15px;
        }
        .select-box.ltr-version .select-option:after{
            right: 15px;
        }
        .select-box.active .country-dropdown-container{
            display: block;
        }
        .select-box.active .select-option:after{
            transform: rotate(-180deg)
        }
    </style>
@endpush
<div class="select-box {{ app()->getLocale() == 'ar' ? "rlt-version" : "ltr-version" }}">
    <div class="select-option">
        <input type="text" placeholder="{{__('meeting_order.Select_country')}}" id="soValue" readonly name="country">
    </div>
    <div class="country-dropdown-container p-3">
        <input type="text" class="form-control-sm w-100 mb-1" id="optionSearch" placeholder="Search">
        <ul class="country-dropdown">
            <li>Afghanistan</li>
            <li>Åland Islands</li>
            <li>Albania</li>
            <li>Algeria</li>
            <li>American Samoa</li>
            <li>Andorra</li>
            <li>Angola</li>
            <li>Anguilla</li>
            <li>Antarctica</li>
            <li>Antigua and Barbuda</li>
            <li>Argentina</li>
            <li>Armenia</li>
            <li>Aruba</li>
            <li>Australia</li>
            <li>Austria</li>
            <li>Azerbaijan</li>
            <li>Bahamas</li>
            <li>Bahrain</li>
            <li>Bangladesh</li>
            <li>Barbados</li>
            <li>Belarus</li>
            <li>Belgium</li>
            <li>Belize</li>
            <li>Benin</li>
            <li>Bermuda</li>
            <li>Bhutan</li>
            <li>Bolivia</li>
            <li>Bosnia and Herzegovina</li>
            <li>Botswana</li>
            <li>Bouvet Island</li>
            <li>Brazil</li>
            <li>British Indian Ocean Territory</li>
            <li>Brunei Darussalam</li>
            <li>Bulgaria</li>
            <li>Burkina Faso</li>
            <li>Burundi</li>
            <li>Cambodia</li>
            <li>Cameroon</li>
            <li>Canada</li>
            <li>Cape Verde</li>
            <li>Cayman Islands</li>
            <li>Central African Republic</li>
            <li>Chad</li>
            <li>Chile</li>
            <li>China</li>
            <li>Christmas Island</li>
            <li>Cocos (Keeling) Islands</li>
            <li>Colombia</li>
            <li>Comoros</li>
            <li>Congo</li>
            <li>Congo, The Democratic Republic of The</li>
            <li>Cook Islands</li>
            <li>Costa Rica</li>
            <li>Cote D'ivoire</li>
            <li>Croatia</li>
            <li>Cuba</li>
            <li>Curaçao</li>
            <li>Cyprus</li>
            <li>Czech Republic</li>
            <li>Denmark</li>
            <li>Djibouti</li>
            <li>Dominica</li>
            <li>Dominican Republic</li>
            <li>Ecuador</li>
            <li>Egypt</li>
            <li>El Salvador</li>
            <li>Equatorial Guinea</li>
            <li>Eritrea</li>
            <li>Estonia</li>
            <li>Ethiopia</li>
            <li>Falkland Islands (Malvinas)</li>
            <li>Faroe Islands</li>
            <li>Fiji</li>
            <li>Finland</li>
            <li>France</li>
            <li>French Guiana</li>
            <li>French Polynesia</li>
            <li>French Southern Territories</li>
            <li>Gabon</li>
            <li>Gambia</li>
            <li>Georgia</li>
            <li>Germany</li>
            <li>Ghana</li>
            <li>Gibraltar</li>
            <li>Greece</li>
            <li>Greenland</li>
            <li>Grenada</li>
            <li>Guadeloupe</li>
            <li>Guam</li>
            <li>Guatemala</li>
            <li>Guernsey</li>
            <li>Guinea</li>
            <li>Guinea-bissau</li>
            <li>Guyana</li>
            <li>Haiti</li>
            <li>Heard Island and Mcdonald Islands</li>
            <li>Holy See (Vatican City State)</li>
            <li>Honduras</li>
            <li>Hong Kong</li>
            <li>Hungary</li>
            <li>Iceland</li>
            <li>India</li>
            <li>Indonesia</li>
            <li>Iran, Islamic Republic of</li>
            <li>Iraq</li>
            <li>Ireland</li>
            <li>Isle of Man</li>
            <li>Israel</li>
            <li>Italy</li>
            <li>Jamaica</li>
            <li>Japan</li>
            <li>Jersey</li>
            <li>Jordan</li>
            <li>Kazakhstan</li>
            <li>Kenya</li>
            <li>Kiribati</li>
            <li>Korea, Democratic People's Republic of</li>
            <li>Korea, Republic of</li>
            <li>Kuwait</li>
            <li>Kyrgyzstan</li>
            <li>Lao People's Democratic Republic</li>
            <li>Latvia</li>
            <li>Lebanon</li>
            <li>Lesotho</li>
            <li>Liberia</li>
            <li>Libyan Arab Jamahiriya</li>
            <li>Liechtenstein</li>
            <li>Lithuania</li>
            <li>Luxembourg</li>
            <li>Macao</li>
            <li>Macedonia, The Former Yugoslav Republic of</li>
            <li>Madagascar</li>
            <li>Malawi</li>
            <li>Malaysia</li>
            <li>Maldives</li>
            <li>Mali</li>
            <li>Malta</li>
            <li>Marshall Islands</li>
            <li>Martinique</li>
            <li>Mauritania</li>
            <li>Mauritius</li>
            <li>Mayotte</li>
            <li>Mexico</li>
            <li>Micronesia, Federated States of</li>
            <li>Moldova, Republic of</li>
            <li>Monaco</li>
            <li>Mongolia</li>
            <li>Montenegro</li>
            <li>Montserrat</li>
            <li>Morocco</li>
            <li>Mozambique</li>
            <li>Myanmar</li>
            <li>Namibia</li>
            <li>Nauru</li>
            <li>Nepal</li>
            <li>Netherlands</li>
            <li>New Caledonia</li>
            <li>New Zealand</li>
            <li>Nicaragua</li>
            <li>Niger</li>
            <li>Nigeria</li>
            <li>Niue</li>
            <li>Norfolk Island</li>
            <li>Northern Mariana Islands</li>
            <li>Norway</li>
            <li>Oman</li>
            <li>Pakistan</li>
            <li>Palau</li>
            <li>Palestinian Territory, Occupied</li>
            <li>Panama</li>
            <li>Papua New Guinea</li>
            <li>Paraguay</li>
            <li>Peru</li>
            <li>Philippines</li>
            <li>Pitcairn</li>
            <li>Poland</li>
            <li>Portugal</li>
            <li>Puerto Rico</li>
            <li>Qatar</li>
            <li>Reunion</li>
            <li>Romania</li>
            <li>Russia</li>
            <li>Rwanda</li>
            <li>Saint Helena</li>
            <li>Saint Kitts and Nevis</li>
            <li>Saint Lucia</li>
            <li>Saint Pierre and Miquelon</li>
            <li>Saint Vincent and The Grenadines</li>
            <li>Samoa</li>
            <li>San Marino</li>
            <li>Sao Tome and Principe</li>
            <li>Saudi Arabia</li>
            <li>Senegal</li>
            <li>Serbia</li>
            <li>Seychelles</li>
            <li>Sierra Leone</li>
            <li>Singapore</li>
            <li>Slovakia</li>
            <li>Slovenia</li>
            <li>Solomon Islands</li>
            <li>Somalia</li>
            <li>South Africa</li>
            <li>South Georgia and The South Sandwich Islands</li>
            <li>Spain</li>
            <li>Sri Lanka</li>
            <li>Sudan</li>
            <li>Suriname</li>
            <li>Svalbard and Jan Mayen</li>
            <li>Eswatini</li>
            <li>Sweden</li>
            <li>Switzerland</li>
            <li>Syrian Arab Republic</li>
            <li>Taiwan (ROC)</li>
            <li>Tajikistan</li>
            <li>Tanzania, United Republic of</li>
            <li>Thailand</li>
            <li>Timor-leste</li>
            <li>Togo</li>
            <li>Tokelau</li>
            <li>Tonga</li>
            <li>Trinidad and Tobago</li>
            <li>Tunisia</li>
            <li>Turkey</li>
            <li>Turkmenistan</li>
            <li>Turks and Caicos Islands</li>
            <li>Tuvalu</li>
            <li>Uganda</li>
            <li>Ukraine</li>
            <li>United Arab Emirates</li>
            <li>United Kingdom</li>
            <li>United States</li>
            <li>United States Minor Outlying Islands</li>
            <li>Uruguay</li>
            <li>Uzbekistan</li>
            <li>Vanuatu</li>
            <li>Venezuela</li>
            <li>Vietnam</li>
            <li>Virgin Islands, British</li>
            <li>Virgin Islands, U.S.</li>
            <li>Wallis and Futuna</li>
            <li>Western Sahara</li>
            <li>Yemen</li>
            <li>Zambia</li>
            <li>Zimbabwe</li>
        </ul>
    </div>
</div>

@push('scripts')
<script>

    const selectBox = document.querySelector('.select-box');
    const selectOption = document.querySelector('.select-option');
    const soValue = document.querySelector('#soValue');
    const optionSearch = document.querySelector('#optionSearch');
    const options = document.querySelector('.country-dropdown');
    const optionList = document.querySelectorAll('.country-dropdown li');
    // console.log(selectBox,selectOption,soValue,optionSearch,options,optionList);

    selectOption.addEventListener('click',function(){
        selectBox.classList.toggle('active');
    });

    optionList.forEach(function(optionListSingle){
        optionListSingle.addEventListener('click',function(){
            text = this.textContent;
            soValue.value = text;
            selectBox.classList.remove('active');
        });
    });

    optionSearch.addEventListener('keyup',function(){
        var filter , li , i , textValue;
        filter = optionSearch.value.toUpperCase();
        li = options.getElementsByTagName('li');
        for(i = 0; i < li.length; i++){
            liCount = li[i];
            textValue = liCount.textContent || liCount.innerText;
            if(textValue.toUpperCase().indexOf(filter) > -1){
                li[i].style.display = '';
            }else{
                li[i].style.display = 'none';
            }
        }
    });
</script>
@endpush