package org.ifundip.mobileirs

import androidx.compose.runtime.*
import cafe.adriel.voyager.navigator.Navigator
import org.jetbrains.compose.ui.tooling.preview.Preview

import mobileirs.composeapp.generated.resources.Res
import mobileirs.composeapp.generated.resources.compose_multiplatform

@Composable
@Preview
fun App() {
    Navigator(
        screen = Login()
    )
}