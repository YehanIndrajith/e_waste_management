<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Log;

class EwasteController extends Controller
{
    public function detectEwaste(Request $request)
    {
        try {
            // Validate that an image is uploaded
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Store the uploaded image temporarily
            $image = $request->file('image');
          
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = storage_path('app/public/uploads/' . $imageName);
            $image->move(storage_path('app/public/uploads/'), $imageName);

            // Log the image path for debugging
            Log::info('Image uploaded: ' . $imagePath);

            // Construct the Python command with full paths
            $pythonScript = base_path('scripts/detect.py');

            $pythonPath = base_path('myenv/Scripts/python.exe'); // Full Python path
            $process = new Process([
                $pythonPath, 
                $pythonScript, 
                $imagePath
            ]);

            $process->setEnv([
                'HOME' => getenv('HOME') ?: 'C:\\Users\\Asus',
                'USERPROFILE' => getenv('USERPROFILE') ?: 'C:\\Users\\Asus'
                
            ]);
            

            // Set timeout and add error output capturing
            $process->setTimeout(60); // 60 seconds timeout
            $process->run();

            // Log the raw output for debugging
            Log::info('Python Script Output: ' . $process->getOutput());
            Log::info('Python Script Error Output: ' . $process->getErrorOutput());

            // Check if the process executed successfully
            if (!$process->isSuccessful()) {
                // Log the specific error
                Log::error('Python script execution failed', [
                    'exit_code' => $process->getExitCode(),
                    'error_output' => $process->getErrorOutput()
                ]);

                return response()->json([
                    'error' => 'Processing failed',
                    'details' => $process->getErrorOutput()
                ], 500);
            }

            // Get the Python script output
            $output = $process->getOutput();
            
            // Attempt to parse the JSON output
            $response = json_decode($output, true);

            // Check if JSON parsing was successful
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('Invalid JSON response', [
                    'raw_output' => $output
                ]);

                return response()->json([
                    'error' => 'Invalid response from detection script',
                    'raw_output' => $output
                ], 500);
            }

            // Optional: Remove the temporary uploaded image
            // Uncomment if you want to delete the image after processing
            // unlink($imagePath);

            return response()->json($response);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            Log::error('Validation Error', [
                'errors' => $e->errors()
            ]);

            return response()->json([
                'error' => 'Validation failed',
                'details' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            // Catch any other unexpected errors
            Log::error('Unexpected Error in E-Waste Detection', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'An unexpected error occurred',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}