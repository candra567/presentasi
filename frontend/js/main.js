const baseUrl = "http://127.0.0.1:8000/api/siswa";
const tableBody = document.querySelector("#tbody");
const formAddSiswa = document.querySelector("#form-siswa");
/*
 * dapatkan data siswa
 */
async function getData() {
  try {
    const resJson = await fetch("http://127.0.0.1:8000/api/siswa");
    const result = await resJson.json();
    let html = "";
    let num = 1;
    for (const item of result.data) {
      html += `<tr>
                    <td>${num++}</td>
                    <td>${item.name_siswa}</td>
                    <td>${item.no_siswa}</td>
                    <td>${item.kelas_siswa}</td>
                    <td class="d-flex justify-content-evenly">
                    <button  class="btn btn-danger btn-sm"  id="btn-delete" data-id="${
                      item.id
                    }" onclick="deleteData(this)">H</button>
                    <button  class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-siswa"  id="btn-edit" data-id="${
                      item.id
                    }" onclick="getEdit(this)">E</button>
                  </td>
               </tr>`;
    }
    tableBody.innerHTML = html;
  } catch (e) {
    alert("Sepertinya ada erorr buka console coba");
    console.error(e);
  }
}
getData();
/**
 * add data siswa
 */
formAddSiswa.addEventListener("submit", async function (event) {
  event.preventDefault();
  const data = new FormData(this);
  try {
    const sendForm = await fetch(baseUrl, {
      method: "POST",
      body: data,
    });
    const responseSend = await sendForm.json();
    this.name_siswa.value = "";
    this.no_siswa.value = "";
    getData();
    document.querySelector("#message-add").innerHTML = printAlert(
      responseSend.message
    );
  } catch (e) {
    alert("Sepertinya ada erorr buka console coba");
    console.error(e);
  }
});
/**
 * delete data
 */
async function deleteData(el) {
  const cft = confirm("Hapus data");
  if (!cft) {
    return false;
  }
  const id = el.getAttribute("data-id");
  const response = await fetch(`${baseUrl}/${id}`, {
    method: "DELETE",
  });
  try {
    const resJson = await response;
    const res = await resJson.json();
    getData();
    document.querySelector("#message-siswa").innerHTML = printAlert(res.message,"danger",50);
  } catch (e) {
      alert("Sepertinya ada erorr buka console coba");
      console.error(e);
  }
}

// get siswa by id
async function getEdit(el) {
  const id = el.getAttribute("data-id");
  const response = await fetch(`${baseUrl}/${id}`);
  const { data } = await response.json();
  const html = `<form  id="form-edit-siswa" class=" mx-auto p-3" data-id="${data.id}" onsubmit="editSiswa(event,this)">
                  <div class="my-2">
                      <label for="name_edit_siswa" class="form-label">Nama siswa</label>
                      <input type="text" name="name_siswa" id="name_edit_siswa" class="form-control" required value="${data.name_siswa}">
                  </div>
                  <div class="my-2">
                      <label for="no_edit_siswa" class="form-label">No siswa</label>
                      <input type="number" name="no_siswa" id="no_edit_siswa" class="form-control" required value="${data.no_siswa}">
                  </div>
                  <div class="my-2">
                      <label for="kelas_siswa" class="form-label">Kelas siswa</label>
                      <select name="kelas_siswa" id="kelas_edit_siswa" class="form-select">
                        <option value="X TKJ">X TKJ</option>
                        <option value="XI TKJ">XI TKJ</option>
                        <option value="XII TKJ">XII TKJ</option>
                      </select>
                  </div>
                  <div class="my-2">
                    <button type="submit" class="btn btn-primary d-block w-100">Edit</button>
                  </div>
                  </form>`;
  document.querySelector("#modal-body-edit-siswa").innerHTML = html;
}
/**
 * edit data siswa
 */
async function editSiswa(event, el) {
  event.preventDefault();
  const id = el.getAttribute("data-id");
  const data = new FormData(el);
  try {
    const fetchEdit = await fetch(`${baseUrl}/${id}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        name_siswa: el.name_siswa.value,
        kelas_siswa: el.kelas_siswa.value,
        no_siswa: el.no_siswa.value,
      }),
    });
    const responseFecth = await fetchEdit;
    const res = await responseFecth.json();
     document.querySelector('.modal-backdrop').remove();
     document.querySelector('#edit-siswa').style.display='none';
     getData();
  } catch (error) {
    alert("Sepertinya ada erorr buka console coba");
    console.error(e);
  }
}

function printAlert(message, color = "primary", width = 100) {
  return `
     <div class="alert alert-${color} w-${width} mx-auto">
     ${message}
     </div>
    `;
}
