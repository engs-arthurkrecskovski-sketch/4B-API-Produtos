<?php

namespace App\Repositories;

use App\Models\Produto;

interface ProdutoRepositoryInterface
{
    public function search(array $filtros);

    public function create(array $dados);

    public function update(Produto $produto, array $dados): Produto;

    public function delete(Produto $produto): bool;
}