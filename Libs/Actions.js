function deleteClase(id) {
    if (confirm('are you sure deleting this?')) {
        fetch('RouterFinal.php?action=deleteClase/' + id, {
            method: 'DELETE',
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al borrar la clase');
            }
            // Recargar la página después de borrar la clase
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}