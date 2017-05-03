<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RecommentCreateRequest;
use App\Http\Requests\RecommentUpdateRequest;
use App\Repositories\RecommentRepository;
use App\Validators\RecommentValidator;


class RecommentsController extends Controller
{

    /**
     * @var RecommentRepository
     */
    protected $repository;

    /**
     * @var RecommentValidator
     */
    protected $validator;

    public function __construct(RecommentRepository $repository, RecommentValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $recomments = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $recomments,
            ]);
        }

        return view('recomments.index', compact('recomments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RecommentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RecommentCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $recomment = $this->repository->create($request->all());

            $response = [
                'message' => 'Recomment created.',
                'data'    => $recomment->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recomment = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $recomment,
            ]);
        }

        return view('recomments.show', compact('recomment'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $recomment = $this->repository->find($id);

        return view('recomments.edit', compact('recomment'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RecommentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(RecommentUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $recomment = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Recomment updated.',
                'data'    => $recomment->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Recomment deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Recomment deleted.');
    }
}
