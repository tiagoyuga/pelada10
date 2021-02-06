<script
    src="https://maps.googleapis.com/maps/api/js?key={{ config('app.mapsKey') }}&libraries=places"></script>
<script src="{{ url('vendor/maps/jquery.geocomplete.js') }}" type="text/javascript"></script>
<script>
    $(function () {

        function formatResults(address_components) {

            console.clear();
            var street_number = null, address = null, neigborhood = null, city = null, state = null,
                country = null, postal_code = null;

            console.log('result.address_components.length  = ' + address_components.length);
            //console.log(address_components);

            address_components.forEach(function (component) {
                console.log(component);
                let value = component.long_name;
                console.log('long_name = ' + component.long_name + ' | short_name = ' + component.short_name);
                component.types.forEach(function (type) {
                    //console.log(type);

                    switch (type) {

                        case 'street_number':
                            street_number = value;
                            break;

                        case 'route':
                            address = value;
                            break;

                        case 'sublocality_level_1':
                            neigborhood = value;
                            break;

                        case 'administrative_area_level_2':
                            city = value;
                            break;

                        case 'administrative_area_level_1':
                            state = value;
                            break;

                        case 'country':
                            country = value;
                            break;

                        case 'postal_code':
                            postal_code = value;
                            break;

                    }
                });
            });

            $("#address").val(address);
            $("#number").val(street_number);
            $("#neighborhood").val(neigborhood);
            $("#city").val(city);
            $("#state").val(state);
            $("#postal_code").val(postal_code);

            if (city && state) {

                $.ajax({
                    type: 'POST',
                    url: "{{ url('api/cities/by-city-state') }}",
                    data: {'city': city, 'state': state},
                    success: function (dados) {

                        console.log(dados.city + ' - ' + dados.id);
                        var newOption = new Option((dados.city), dados.id, false, false);
                        $('#city_id').append(newOption).trigger('change');

                        var newOption = new Option((dados.city), 1234, false, false);
                        $('#city_id').append(newOption).trigger('change');
                        $('#city_id').val(dados.id);
                    },
                    error: function () {
                        showMessage('e', 'Erro ao pesquisar cidade', 2);
                    }
                });
            }

            //console.log('------------');

            console.log('Endereço: ' + address + ' - Número: ' + street_number + ' - Bairro: ' + neigborhood + ' - Cidade: ' + city + ' - Estado: ' + state + ' - País: ' + country + ' - CEP: ' + postal_code);

            /*var country = null, countryCode = null, city = null, cityAlt = null;
            var c, lc, component;
            for (var r = 0, rl = results.length; r < rl; r += 1) {
                var result = results[r];

                if (!city && result.types[0] === 'locality') {
                    for (c = 0, lc = result.address_components.length; c < lc; c += 1) {
                        component = result.address_components[c];

                        if (component.types[0] === 'locality') {
                            city = component.long_name;
                            break;
                        }
                    }
                } else if (!city && !cityAlt && result.types[0] === 'administrative_area_level_1') {
                    for (c = 0, lc = result.address_components.length; c < lc; c += 1) {
                        component = result.address_components[c];

                        if (component.types[0] === 'administrative_area_level_1') {
                            cityAlt = component.long_name;
                            break;
                        }
                    }
                } else if (!country && result.types[0] === 'country') {
                    country = result.address_components[0].long_name;
                    countryCode = result.address_components[0].short_name;
                }

                if (city && country) {
                    break;
                }
            }

            console.log("City: " + city + ", City2: " + cityAlt + ", Country: " + country + ", Country Code: " + countryCode);*/
        }

        //maps
        let options = {
            map: ".map_canvas",
            details: "form",
            detailsAttribute: "data-geo",
            types: ["geocode", "establishment"],
            @if(isset($item) && !empty($item->lat))
            location: new google.maps.LatLng({{ $item->lat }}, {{ $item->lng }}),
            @else
            location: new google.maps.LatLng(-5.036624, -42.766145),
            @endif
            mapOptions: {
                zoom: 17
            },
            markerOptions: {
                draggable: true
            }
        };

        $("#address").geocomplete(options)
            //Fired when the marker's position was modified manually. Passes the updated location.
            .bind("geocode:dragged", function (event, result) {

                console.log('.bind("geocode:dragged"');
                console.log(result);

                $("input[name=lat]").val(result.lat());
                $("input[name=lng]").val(result.lng());

                $("#reset").show();

                var latlng;
                latlng = new google.maps.LatLng(result.lat(), result.lng()); // New York, US
                //latlng = new google.maps.LatLng(37.990849233935194, 23.738339349999933); // Athens, GR
                //latlng = new google.maps.LatLng(48.8567, 2.3508); // Paris, FR
                //latlng = new google.maps.LatLng(47.98247572667902, -102.49018710000001); // New Town, US
                //latlng = new google.maps.LatLng(35.44448406385493, 50.99001635390618); // Parand, Tehran, IR
                //latlng = new google.maps.LatLng(34.66431108560504, 50.89113940078118); // Saveh, Markazi, IR

                new google.maps.Geocoder().geocode({'latLng': latlng}, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {

                        console.log(results);
                        if (results[1] && results[1].address_components) {

                            formatResults(results[1].address_components);
                        }
                    }
                });
            })
            //Geocode was successful. Passes the original result as described https://developers.google.com/maps/documentation/javascript/geocoding?csw=1#GeocodingResults.
            .bind("geocode:result", function (event, result) {
                /*
                {
                 types[]: string,
                 formatted_address: string,
                 address_components[]: {
                   short_name: string,
                   long_name: string,
                   postcode_localities[]: string,
                   types[]: string
                 },
                 partial_match: boolean,
                 place_id: string,
                 postcode_localities[]: string,
                 geometry: {
                   location: LatLng,
                   location_type: GeocoderLocationType
                   viewport: LatLngBounds,
                   bounds: LatLngBounds
                 }
                }
                * */
                //if(result.address_components){

                console.log(result.address_components);
                formatResults(result.address_components);
                //}
                console.log('.bind("geocode:result"');
                console.log(result);
            })
            .bind("geocode:error", function (event, status) {
                console.log('.bind("geocode:error" status = ' + status);
            });


        /*$("#reset").click(function () {
            $("#address").geocomplete("resetMarker");
            $("#reset").hide();
            return false;
        });

        $("#find").click(function () {
            $("#address").trigger("geocode");
        }).click();*/

    });

    /*$(".blur_maps").on('click', function (e) {

        e.preventDefault();

        let dataSearch = $("#address").val() + " " + $("#number").val() + " " + $("#neighborhood").val() + " " + $("#city").val() + " " + $("#state").val();
        console.log(dataSearch);

        $('#address').val(dataSearch);
        $("#address").trigger("geocode");

    });*/

</script>
