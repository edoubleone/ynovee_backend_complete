<?php

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Test API",
 *     version="1.0.0"
 * )
 */

/**
 * @OA\PathItem(
 *     path="/api/test"
 * )
 */

/**
 * @OA\Get(
 *     path="/api/test",
 *     summary="Test endpoint",
 *     tags={"Test"},
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
 */