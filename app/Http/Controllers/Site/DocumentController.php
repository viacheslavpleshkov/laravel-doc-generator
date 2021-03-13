<?php

namespace App\Http\Controllers\Site;

use App\Repositories\OrderRepository;
use App\Repositories\UserFillInputRepository;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use App\Repositories\DocumentFileRepository;

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
     * @var DocumentFileRepository
     */
    protected $documentFileRepository;

    /**
     * DocumentController constructor.
     */
    public function __construct()
    {
        $this->userFillInputRepository = new UserFillInputRepository;
        $this->orderRepository = new OrderRepository;
        $this->documentFileRepository = new DocumentFileRepository();
    }

    /**
     * @param $user_input
     * @return float|int
     */
    public function amount_debt($user_input)
    {
        if ($user_input <= 100000) {
            $value = $user_input * 0.04;
            if ($value <= 2000)
                $value = 2000;
            return $value;
        } elseif ($user_input >= 100001 && $user_input <= 200000)
            return 4000 + 0.03 * (200000 - 100000);
        elseif ($user_input >= 200001 && $user_input <= 1000000)
            return 7000 + 0.02 * (1000000 - 200000);
        elseif ($user_input >= 1000001 && $user_input <= 2000000)
            return 23000 + 0.01 * (2000000 - 1000000);
        else {
            $value = 33000 + 0.005 * ($user_input - 2000000);
            if ($value >= 200000)
                $value = 200000;
            return $value;
        }
    }

    /**
     * @param $user_id
     * @param $situation_id
     * @param $document
     * @return mixed
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function create_document($user_id, $situation_id, $document)
    {
        $user_fill_input = $this->userFillInputRepository->getDocumentAll($user_id, $situation_id);
        if (!$user_fill_input->isEmpty()) {
            $path = $this->documentFileRepository->getById($document->id)->file_path;
            $title = str_replace(" ", "-", mb_convert_case($document->title, MB_CASE_LOWER, "UTF-8"));
            $user_path = 'docx/' . $user_id . '/' . $title . '-' . rand() . '.docx';

            Storage::copy($path, $user_path);
            $templateProcessor = new TemplateProcessor(storage_path('app/' . $user_path));
            foreach (($user_fill_input) as $value) {
                $templateProcessor->setValue('${' . $value->document->key . '}', $value->user_input);
                if ($value->document->key == "amount_debt" && is_numeric((int)$this->amount_debt($value->user_input)))
                    $templateProcessor->setValue('${gov_tax}', (int)$this->amount_debt($value->user_input));
            }
            $templateProcessor->saveAs(storage_path('app/' . $user_path));

            return $this->orderRepository->create([
                'file_path' => $user_path,
                'situation_id' => $situation_id,
                'user_id' => $user_id,
                'price' => $this->documentFileRepository->getById($document->id)->price,
                'status' => 0,
            ]);
        }
    }
}
