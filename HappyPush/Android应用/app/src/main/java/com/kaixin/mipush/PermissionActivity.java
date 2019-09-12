package com.kaixin.mipush;

import android.app.Activity;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;

public class PermissionActivity extends Activity {
    private static final int PERMISSION_REQUEST = 1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        if (Build.VERSION.SDK_INT >= 23) {
            Intent intent = getIntent();
            String permissions[] = intent.getStringArrayExtra("permissions");
            for (int i = 0; i < permissions.length; ++i) {
                if (checkSelfPermission(permissions[i]) != PackageManager.PERMISSION_GRANTED) {
                    requestPermissions(permissions, PERMISSION_REQUEST);
                    break;
                }
            }
        }

    }

    @Override
    public void onRequestPermissionsResult (int requestCode,
                                            String[] permissions,
                                            int[] grantResults) {
        if (requestCode == PERMISSION_REQUEST) {
            boolean granted = false;
            for (int i = 0; i < grantResults.length; ++i) {
                if (grantResults[i] == PackageManager.PERMISSION_GRANTED) {
                    granted = true;
                }
            }

            if (granted) {
                Log.w("PermissionActivity", "Permissions granted:");
                MyApplication.reInitPush(this);
            }
            finish();
        }
    }
}
