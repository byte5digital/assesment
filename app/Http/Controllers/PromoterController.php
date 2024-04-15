<?php

namespace App\Http\Controllers;

use App\Models\Promoter;
use App\Models\Skill;
use Illuminate\Http\Request;



/**
 * @OA\Info(
 *    title="Promoter API",
 *    description="This API provides CRUD operations for managing promoters",
 *    version="1.0.0",
 * )
 */

class PromoterController extends Controller
{   
    /**
     * @OA\Get(
     *      path="/api/promoter/{id}",
     *      operationId="getPromoterById",
     *      tags={"Promoters"},
     *      summary="Get a promoter by ID",
     *      description="Returns a single promoter based on ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the promoter",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *                  type="object",
     *                  ref="#/components/schemas/Promoter"
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Promoter not found"
     *       )
     * )
    */
    public function show($id){
        $promoter = Promoter::findOrFail($id);
        return response()->json($promoter);
    }

    /**
     * @OA\Post(
     *      path="/api/promoter",
     *      operationId="storePromoter",
     *      tags={"Promoters"},
     *      summary="Create a new promoter",
     *      description="Creates a new promoter with the provided data",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Promoter data",
     *          @OA\JsonContent(
     *              type="array",
     *                  type="object",
     *                  ref="#/components/schemas/Promoter"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Promoter created successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Promoter created successfully")
     *          )
     *      ),
     *      @OA\Response(
     *      response=500,
     *      description="Error creating promoter",
     *      @OA\JsonContent(
     *          @OA\Property(property="message", type="string", example="Error creating promoter"),
     *          @OA\Property(
     *     property="Errors",
     *     type="array",
     *     @OA\Items(type="string", example="Error message 1"),
     *      example={"Error message 1", "Error message 2"}
     *     )
     *     )
     * )
     * 
     * )
    */

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:60',
            'last_name' => 'required|string|max:80',
            'email' => 'required|string|email|unique:promoters,email|max:150',
        ]);


        try {
            $promoter = Promoter::create([
                'name' => $validatedData['name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
            ]);
    
            // Return success message
            return response()->json(['message' => 'Promoter created successfully'], 201);
        } catch (\Exception $e) {
            // Return error message.
            return response()->json(['message' => 'Error creating promoter: ' . $e->getMessage()], 500);
        } 
    }


    /**
     * @OA\Put(
     *      path="/api/promoter/{id}",
     *      operationId="updatePromoter",
     *      tags={"Promoters"},
     *      summary="Update a promoter",
     *      description="Update a promoter by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the promoter to update",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="The name of the promoter"
     *                  ),
     *                  @OA\Property(
     *                      property="last_name",
     *                      type="string",
     *                      description="The last name of the promoter"
     *                  ),
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      format="email",
     *                      description="The email of the promoter"
     *                  ),
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Promoter updated successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Promoter updated successfully")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Promoter not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Promoter not found")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The given data was invalid.")
     *          )
     *      ),
     * )
    */
    public function update(Request $request, $id)
    {
        $promoter = Promoter::find($id);

        if (!$promoter) {
            return response()->json(['message' => 'Promoter not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'string|max:60',
            'last_name' => 'string|max:80',
            'email' => 'string|email|max:150|unique:promoters,email,' . $id,
        ]);

        $promoter->update($validatedData);

        return response()->json(['message' => 'Promoter updated successfully'], 200);
    }


    /**
     * @OA\Delete(
     *      path="/api/promoter/{id}",
     *      operationId="deletePromoter",
     *      tags={"Promoters"},
     *      summary="Delete a promoter",
     *      description="Delete a promoter by ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID of the promoter to delete",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Promoter deleted successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Promoter deleted successfully")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Promoter not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Promoter not found")
     *          )
     *      ),
     * )
    */
public function destroy($id)
{
    $promoter = Promoter::find($id);

    if (!$promoter) {
        return response()->json(['message' => 'Promoter not found'], 404);
    }

    $promoter->delete();

    return response()->json(['message' => 'Promoter deleted successfully'], 200);
}


/**
 * @OA\Put(
 *      path="/api/promoter/skill-add/{id}",
 *      operationId="addSkillToPromoter",
 *      tags={"Promoters"},
 *      summary="Add a skill to a promoter",
 *      description="Add a skill to a promoter by ID",
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          description="ID of the promoter",
 *          required=true,
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"skill_id"},
 *              @OA\Property(property="skill_id", type="integer", example=1, description="ID of the skill to add to the promoter")
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Skill added successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Skill added successfully")
 *          )
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="Promoter not found",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Promoter not found")
 *          )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Validation error",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="The given data was invalid.")
 *          )
 *      ),
 * )
*/
public function skillAdd(Request $request, $id)
{
    $promoter = Promoter::find($id);

    if (!$promoter) {
        return response()->json(['message' => 'Promoter not found'], 404);
    }

    $validatedData = $request->validate([
        'skill_id' => 'required|integer|exists:skills,id',
    ]);
    $skill = Skill::find($validatedData['skill_id']);
    $promoter->skills()->attach($skill);

    return response()->json(['message' => 'Skill added successfully'], 200);
}

}
