let provinsiData;
let kotaKabupatenData;
let kecamatanData;
let kelurahanData;

// Load data
fetch('/json/provinsi.json')
    .then(response => response.json())
    .then(data => {
        provinsiData = data;
        })
    .catch(error => console.error('Error fetching provinsi data:', error));
fetch('/json/kabupaten.json')
    .then(response => response.json())
    .then(data => {
        kotaKabupatenData = data;
        })
    .catch(error => console.error('Error fetching provinsi data:', error));
fetch('/json/kecamatan.json')
    .then(response => response.json())
    .then(data => {
        kecamatanData = data;
        })
    .catch(error => console.error('Error fetching provinsi data:', error));
fetch('/json/kelurahan.json')
    .then(response => response.json())
    .then(data => {
        kelurahanData = data;
        })
    .catch(error => console.error('Error fetching provinsi data:', error));

// let provinsiData = {!! file_get_contents(public_path('json/provinsi.json')) !!};
// let kotaKabupatenData = {!! file_get_contents(public_path('json/kabupaten.json')) !!};
// let kecamatanData = {!! file_get_contents(public_path('json/kecamatan.json')) !!};
// let kelurahanData = {!! file_get_contents(public_path('json/kelurahan.json')) !!};

// Hanya untuk tambah data
// populateSelect(provinsiData, 'provinsi', 'Pilih Provinsi', 'name');

function populateSelect(data, selectId, placeholder, sortBy) {
    let select = $('#' + selectId);
    select.empty();
    select.append('<option value="" selected>' + placeholder + '</option>');

    // Sort data based on sortBy parameter
    data.sort(function (a, b) {
        return a[sortBy].localeCompare(b[sortBy]);
    });

    $.each(data, function (key, value) {
        select.append('<option value="' + value.name + '">' + value.name + '</option>');
    });
}

// Change event untuk Provinsi
$('#provinsi').change(function () {
    let provinceName = $(this).val();

    // Find the corresponding province ID based on the selected province name
    let selectedProvince = provinsiData.find(function (item) {
        return item.name === provinceName;
    });

    let provinceId = selectedProvince ? selectedProvince.id : null;

    if (provinceId !== null) {
        // Filter Kota/Kabupaten data based on selected Provinsi
        let filteredData = kotaKabupatenData.filter(function(item) {
            return item.provinsi_id == provinceId;
        });

        populateSelect(filteredData, 'kota', 'Pilih Kota/Kabupaten', 'name');
        populateSelect([], 'kecamatan', 'Pilih Kecamatan', 'name');
        populateSelect([], 'kelurahan', 'Pilih Kelurahan', 'name');
    }
});

// Change event untuk Kabupaten/Kota
$('#kota').change(function () {
    let regencyName = $(this).val();

    // Find the corresponding regency ID based on the selected regency name
    let selectedRegency = kotaKabupatenData.find(function (item) {
        return item.name === regencyName;
    });

    let regencyId = selectedRegency ? selectedRegency.id : null;

    if (regencyId !== null) {
        // Filter Kecamatan data based on selected Kabupaten/Kota
        let filteredData = kecamatanData.filter(function(item) {
            return item.kabupaten_id == regencyId;
        });

        populateSelect(filteredData, 'kecamatan', 'Pilih Kecamatan', 'name');
        populateSelect([], 'kelurahan', 'Pilih Kelurahan', 'name');
    }
});

// Change event untuk Kecamatan
$('#kecamatan').change(function () {
    let districtName = $(this).val();

    // Find the corresponding district ID based on the selected district name
    let selectedDistrict = kecamatanData.find(function (item) {
        return item.name === districtName;
    });

    let districtId = selectedDistrict ? selectedDistrict.id : null;

    if (districtId !== null) {
        // Filter Kelurahan data based on selected Kecamatan
        let filteredData = kelurahanData.filter(function(item) {
            return item.kecamatan_id == districtId;
        });

        populateSelect(filteredData, 'kelurahan', 'Pilih Kelurahan', 'name');
    }
});
