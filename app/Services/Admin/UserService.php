<?php

namespace Services\Admin;

use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Eloquent\UserRepository;

class UserService
{
    /**
     * @var $userRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all data.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->userRepository->getAll();
    }

    /**
     * Get data by id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->userRepository->getById($id);
    }

    /**
     * Get datatable data.
     *
     * @return String
     */
    public function getDatatable()
    {
        return $this->userRepository->getDatatable();
    }

    /**
     * Get data by query.
     *
     * @return String
     */
    public function getDataByQuery($data)
    {
        return $this->userRepository->getDataByQuery($data);
    }

    /**
     * Get data admin by query.
     *
     * @return String
     */
    public function getDataAdminByQuery($data)
    {
        return $this->userRepository->getDataAdminByQuery($data);
    }

    /**
     * Get data member by query.
     *
     * @return String
     */
    public function getDataMemberByQuery($data)
    {
        return $this->userRepository->getDataMemberByQuery($data);
    }

    /**
     * Get data admin.
     *
     * @return String
     */
    public function isAdmin()
    {
        return $this->userRepository->isAdmin();
    }

    /**
     * Get data member.
     *
     * @return String
     */
    public function isMember()
    {
        return $this->userRepository->isMember();
    }

    public function save($data)
    {
        $user = $this->userRepository->save($data);

        return $user;
    }

    public function update($data, $id)
    {
        DB::beginTransaction();

        try {
            $user = $this->userRepository->update($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat memperbaharui data anggota.');
        }

        DB::commit();

        return $user;
    }

    /**
     * Delete data by id.
     *
     * @param $id
     * @return String
     */
    public function deleteById($id)
    {
        DB::beginTransaction();

        try {
            $user = $this->userRepository->delete($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Tidak dapat menghapus data anggota.');
        }

        DB::commit();

        return $user;

    }
}