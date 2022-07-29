$(function () {
    const baseUrl= 'http://127.0.0.1:8000/api/siswa/';
    function fetchData() {
        $.ajax({
            url:baseUrl,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                let num = 1;
                let html = '';
                for (const item of res.data) {

                    html += `
                    <tr>
                    <td>${num++}</td>
                    <td>${item.name_siswa}</td>
                    <td>${item.no_siswa}</td>
                    <td>${item.kelas_siswa}</td>
                    <td class="d-flex justify-content-evenly">
                    <button  class="btn btn-danger btn-sm"  id="btn-delete" data-id="${item.id}">H</button>
                    <button  class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-siswa"  id="btn-edit" data-id="${item.id}">E</button>
                   </td>
                   </tr>
                    `;
                }
                $('#tbody').html(html)
            }
        });
    }
    fetchData()
    /**
     * add data siswa
     */
    $('#form-siswa').on('submit', function (evt) {
        evt.preventDefault();
        let data = new FormData($(this)[0]);
        $.ajax({
            url: baseUrl,
            type: 'POST',
            cache: false,
            processData: false,
            contentType: false,
            data: data,
            success: function (result) {
                fetchData();
                $('#name_siswa').val('');
                $('#no_siswa').val('');
                $('#message-add').html(printAlert(result.message));
            },
            error: function (e) {
                console.log(e);
            }
        })
    })

    // edit siswa
    $('#tbody').on('click', '#btn-edit', function () {
        const id = $(this).attr('data-id');
        $.ajax({
            url: baseUrl+id,
            type: 'GET',
            dataType: 'json',
            success: function (result) {
                const res = result.data;
                const html = `
                    <div class="my-2">
                    <label for="name_edit_siswa" class="form-label">Nama siswa</label>
                    <input type="text" name="name_siswa" id="name_edit_siswa" class="form-control" required value="${res.name_siswa}">
                </div>
                <div class="my-2">
                    <label for="no_edit_siswa" class="form-label">No siswa</label>
                    <input type="number" name="no_siswa" id="no_edit_siswa" class="form-control" required value="${res.no_siswa}">
                </div>
                <div class="my-2">
                    <label for="kelas_edit_siswa" class="form-label">Kelas siswa</label>
                    <input type="text" name="kelas_siswa" id="kelas_edit_siswa" class="form-control" required value="${res.kelas_siswa}">
                </div>
                <div class="my-2">
                            <button type="submit" id="btn-edit-siswa" class="btn btn-primary d-block w-100" data-id="${res.id}">Edit</button>
                        </div>   
             `;
             $('#form-edit-siswa').html(html);
            },
            error: function (e) {
                console.log(e);
            }
        })
    })

    $('#form-edit-siswa').on('submit',function(evt){
        evt.preventDefault();
        const data=new FormData($(this)[0]);
        const id=$('#btn-edit-siswa').attr('data-id');
        data.append('_method','PUT')
        $.ajax({
            url: baseUrl+id,
            type: 'POST',
            cache: false,
            processData: false,
            contentType: false,
            data: data,
            success:function(res){
                $('#edit-siswa').modal('hide');
                fetchData();
                $('#message-siswa').html(printAlert(res.message))
            },
            error:function(e){
                console.log(e);
            }
        })
    })

    // delete siswa
    $('#tbody').on('click', '#btn-delete', function () {
        const id = $(this).attr('data-id');
        let cft=confirm('Anda akan menghapus data ?');
        if (!cft) {
            return false;
        }
        $.ajax({
            url: baseUrl+id,
            type: 'DELETE',
             success: function (res) {
                fetchData();
                $('#message-siswa').html(printAlert(res.message,'danger'));
            },
            error: function (e) {
                console.log(e);
            }
        })
    })
    // function print alert
    function printAlert(message, color = "primary", width = 100) {
        return `
           <div class="alert alert-${color} w-${width} mx-auto">
           ${message}
           </div>
          `;
      }
})