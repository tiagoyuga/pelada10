Página {{ $data->currentPage()  }} de {{ $data->lastPage() }}. Exibindo
do {{ $data->firstItem() }} ao {{ $data->lastItem() }} de um total
de {{ $data->total() }} itens.
<ul class="pagination pull-right">
    {{ $data->appends(Request::query())->links() }}
</ul>