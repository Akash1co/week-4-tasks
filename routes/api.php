use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class);
});