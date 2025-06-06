<?php

namespace App\Repository;

use Closure;
use Exception;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Throwable;

abstract class MainRepository
{

    /**
     * @var Model|null
     */
    protected Model|null $model = null;


    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->initModel();
    }

    /**
     * @return string
     */
    abstract public function model(): string;

    /**
     * @return Model|null
     */
    protected function initModel(): ?Model
    {
        if (is_null($this->model)) {
            $this->model = app($this->model());
        }
        return $this->model;
    }

    /**
     * @param string|null $connection
     * @return ConnectionInterface
     */
    private function _getDbConnection(string $connection = null): ConnectionInterface
    {
        return DB::connection($connection ?? config("database.default"));
    }

    /**
     * @param Closure $callback
     * @param string|null $connection
     * @return mixed
     * @throws Throwable
     */
    public function applyTransaction(Closure $callback, ?string $connection = null): mixed
    {
        return ($this->_getDbConnection($connection))->transaction($callback);
    }

    /**
     * @return Builder
     */
    public function builder(): Builder
    {
        return DB::table($this->model->getTable());
    }

    /**
     * @return string
     */
    public function tableName(): string
    {
        return $this->model->getTable();
    }

    /**
     * @return EloquentBuilder
     */
    public function query(): EloquentBuilder
    {
        return $this->model->query();
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function add(array $data): mixed
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data): mixed
    {
        return $this->model::insert($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insertGetId(array $data): mixed
    {
        return $this->model->insertGetId($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insertOrIgnore(array $data): mixed
    {
        return $this->model->insertOrIgnore($data);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes): mixed
    {
        return tap($this->model->where("id", $id))
            ->update($attributes)
            ->first();
    }

    /**
     * @param array $filters
     * @param array $attributes
     * @return mixed
     */
    public function updateManyWhere(array $filters, array $attributes): mixed
    {
        return $this->model->where($filters)->update($attributes);
    }

    /**
     * @param string $column
     * @param array $ids
     * @param array $attributes
     * @return mixed
     */
    public function updateWhereIn(string $column, array $ids,  array $attributes): mixed
    {
        return $this->model->whereIn($column, $ids)->update($attributes);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id): mixed
    {
        return $this->model->find($id);
    }

    /**
     * @param array $filters
     * @param array $with
     * @param string $orderBy
     * @param string $direction
     * @param array $columns
     * @return mixed
     */
    public function findAll(array $filters = [], array $with = [], array $withCount = [], string $orderBy = 'created_at', string $direction = 'DESC', array $columns = ['*'], int $limit = 0): mixed
    {
        $query = $this->model
            ->where($filters)
            ->with($with)
            ->select($columns)
            ->withCount($withCount)
            ->orderBy($orderBy, $direction);
        if ($limit)
            $query->limit($limit);
        return $query->get();
    }
    /**
     * allData
     *
     * @param  mixed $filters
     * @param  mixed $with
     * @param  mixed $orderBy
     * @param  mixed $direction
     * @param  mixed $columns
     * @return mixed
     */
    public function allData($page, $perPage, array $with = [], string $orderBy = 'created_at', string $direction = 'DESC', array $columns = ['*']): mixed
    {
        return $this->model
            ->with($with)
            ->select($columns)
            ->orderBy($orderBy, $direction)
            ->paginate($perPage, '*', 'page', $page);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findOrFail(int $id): mixed
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param array $search
     * @param array $create
     * @return object
     */
    public function firstOrCreate(array $search, array $create = []): object
    {
        return $this->model->firstOrCreate($search, $create);
    }


    /**
     * @param array $filters
     * @param array $with
     * @param array $withCount
     * @param array $columns
     * @return mixed
     */
    public function firstOrFailBy(array $filters = [], array $with = [], array $withCount = [], array $columns = ['*']): mixed
    {
        return $this->model
            ->with($with)
            ->withCount($withCount)
            ->where($filters)
            ->select($columns)
            ->firstOrFail();
    }

    /**
     * @param array $filters
     * @param array $with
     * @param array $withCount
     * @param array $columns
     * @return mixed
     */
    public function firstBy(array $filters = [], array $with = [], array $withCount = [], array $columns = ['*']): mixed
    {
        return $this->model
            ->with($with)
            ->withCount($withCount)
            ->where($filters)
            ->select($columns)
            ->first();
    }

    /**
     * @param array $ids
     * @return bool|null
     * @throws Exception
     */
    public function delete(array $ids): ?bool
    {
        return $this->model->whereIn("id", $ids)->delete();
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws Exception
     */
    public function deleteOne(int $id): ?bool
    {
        return $this->model->where("id", $id)->delete();
    }
}
