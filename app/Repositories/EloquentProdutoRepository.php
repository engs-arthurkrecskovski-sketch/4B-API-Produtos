<?php

namespace App\Repositories;

use App\Models\Produto;

class EloquentProdutoRepository implements ProdutoRepositoryInterface
{
    public function search(array $filtros)
    {
        $query = Produto::query();

        // Filtro original: busca por nome
        if (!empty($filtros['search'])) {
            $query->where('nome', 'like', '%' . $filtros['search'] . '%');
        }

        // NOVO FILTRO 1: faixa de preço
        if (isset($filtros['preco_min'])) {
            $query->where('preco', '>=', $filtros['preco_min']);
        }
        if (isset($filtros['preco_max'])) {
            $query->where('preco', '<=', $filtros['preco_max']);
        }

        // NOVO FILTRO 2: somente produtos em estoque
        if (!empty($filtros['em_estoque'])) {
            $query->where('quantidade', '>', 0);
        }

        return $query->paginate(15);
    }

    public function create(array $dados)
    {
        return Produto::create($dados);
    }

    public function update(Produto $produto, array $dados): Produto
    {
        $produto->update($dados);

        return $produto->fresh();
    }

    public function delete(Produto $produto): bool
    {
        return (bool) $produto->delete();
    }
}