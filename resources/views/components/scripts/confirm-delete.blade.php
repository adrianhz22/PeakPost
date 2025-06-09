<script>
    function confirmDelete(postId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¡Esta acción es irreversible, la publicación será eliminada permanentemente!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'blue',
            cancelButtonColor: 'red',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm-' + postId).submit();
            }
        });
    }
</script>
