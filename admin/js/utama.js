const data_ni = sessionStorage.getItem('user');
const user_ni = JSON.parse(data_ni);
const namaTampil = document.getElementById('nama_ni')
const namautama = document.getElementById('namamu')
namautama.innerHTML = user_ni[0]["Nama"]
namaTampil.innerHTML = user_ni[0]["Nama"]

