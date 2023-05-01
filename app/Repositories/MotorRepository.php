<?php

namespace App\Repositories;

use App\Models\Motor;

class MotorRepository
{
    /**
     * Get all motor data from database
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return Motor::all();
    }

    /**
     * Get motor data by id
     *
     * @param string $id
     * @return mixed
     */
    public function getById($id)
    {
        return Motor::find($id);
    }

    /**
     * Create new motor data in database
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return Motor::create($data);
    }

    /**
     * Update existing motor data in database
     *
     * @param \App\Models\Motor $motor
     * @param array $data
     * @return mixed
     */
    public function update(Motor $motor, array $data)
    {
        $motor->update($data);
        return $motor;
    }

    /**
     * Delete motor data from database
     *
     * @param string $id
     * @return mixed
     */
    public function delete($id)
    {
        return Motor::destroy($id);
    }
}
