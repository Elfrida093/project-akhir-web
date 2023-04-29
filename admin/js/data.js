const dataForm = sessionStorage.getItem('dataUserKey')
const userForm = JSON.parse(dataForm)

const form = document.getElementById('frm')
const nama = document.getElementById('nama')
const email = document.getElementById('email')
const st = document.getElementById('status')
const telp = document.getElementById('telp')
const alamat = document.getElementById('alamat')
const gambar = document.getElementById('gambar')
const jk = document.getElementById('jk')
const hobi1 = document.getElementById('makan')
const hobi2 = document.getElementById('turu')
const hobi3 = document.getElementById('ngoding')

nama.innerHTML = " " + userForm[0]["Nama"]
email.innerHTML = " " + userForm[0]["email"]
st.innerHTML = " " + userForm[0]["status"]
telp.innerHTML = " " + userForm[0]["telp"]
alamat.innerHTML = " " + userForm[0]["alamat"]
jk.innerHTML = "   " + userForm[0]["dot-1"]
jk.innerHTML = "   " + userForm[0]["dot-2"]
jk.innerHTML = "   " + userForm[0]["dot-3"]
hobi1.innerHTML = " " + userForm[0]["makan"]
hobi2.innerHTML = " " + userForm[0]["turu"]
hobi3.innerHTML = " " + userForm[0]["ngoding"]

var span = document.createElement('span');
  span.innerHTML = '<img class="thumb" src="' + userForm[0]["gambar"] + '"/>';
  document.getElementById('gambar').insertBefore(span, null);