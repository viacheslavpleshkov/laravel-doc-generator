<?php

namespace App\Http\Controllers\Site;

use App\Repositories\OrderRepository;
use App\Repositories\UserFillInputRepository;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;

/**
 * Class DocumentController
 * @package App\Http\Controllers\Site
 */
class DocumentController extends BaseController
{

    /**
     * @var UserFillInputRepository
     */
    protected $userFillInputRepository;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * DocumentController constructor.
     */
    public function __construct()
    {
        $this->userFillInputRepository = new UserFillInputRepository;
        $this->orderRepository = new OrderRepository;
    }

    /**
     * @param $user_id
     * @param $situation_id
     * @return mixed
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function create_document($user_id, $situation_id)
    {
        $user_fill_input = $this->userFillInputRepository->getDocumentAll($user_id, $situation_id);
        if (!$user_fill_input->isEmpty()) {
            $path = $user_fill_input[0]->document->documentfile->file_path;
            $user_path = 'docx/' . $user_id . '/Voucher-' . time() . '.docx';

            Storage::copy($path, $user_path);
            $templateProcessor = new TemplateProcessor(storage_path('app/' . $user_path));
            foreach (($user_fill_input) as $value)
                $templateProcessor->setValue('${' . $value->document->key . '}', $value->user_input);
            $templateProcessor->saveAs(storage_path('app/' . $user_path));

            return $this->orderRepository->create([
                'file_path' => $user_path,
                'user_id' => $user_id,
                'status' => 0,
            ])->id;
        }
    }
}
