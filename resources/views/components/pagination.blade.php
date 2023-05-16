@props(['query'])
<p class="text-center">Página {{ $query->currentPage() }} de {{ $query->lastPage() }}. Total de registros: {{ $query->total() }}.</p>
<div class="container-fluid">
  {{ $query->links() }}
</div>