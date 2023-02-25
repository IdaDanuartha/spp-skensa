$(document).ready(function() {

    $('.detail-kelas-btn').on('click', function() {
        const id = $(this).closest('.kelas_data').find('.kelas_id').val()
        console.log(id)
        $.ajax({
            url: `http://localhost/spp-skensa/public/kelas/detail/${id}`,
            method: 'POST',
            success: (response) => {
                const res = JSON.parse(response)

                $(".kelas_id").val(res.id)
                $(".nama_kelas").html(`"${res.nama}"`)                  
            }
        })
    })

})