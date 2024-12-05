package org.ifundip.mobileirs

import androidx.compose.animation.AnimatedVisibility
import androidx.compose.foundation.Image
import androidx.compose.foundation.border
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.text.BasicTextField
import androidx.compose.material.Button
import androidx.compose.material.MaterialTheme
import androidx.compose.material.Text
import androidx.compose.runtime.*
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.text.TextStyle
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.text.input.TextFieldValue
import androidx.compose.ui.text.input.VisualTransformation
import androidx.compose.ui.unit.dp
import org.jetbrains.compose.resources.painterResource
import org.jetbrains.compose.ui.tooling.preview.Preview
import cafe.adriel.voyager.navigator.Navigator

import mobileirs.composeapp.generated.resources.Res
import mobileirs.composeapp.generated.resources.compose_multiplatform

@Composable
@Preview
fun App() {
    Navigator(
        screen = Login()
    )

//    MaterialTheme {
//        var showContent by remember { mutableStateOf(false) }
//        Column(
//            modifier = Modifier
//                .fillMaxSize()
//                .padding(16.dp),
//            horizontalAlignment = Alignment.CenterHorizontally,
//            verticalArrangement = Arrangement.Center
//        ) {
//            Image(
//                painter = painterResource(Res.drawable.compose_multiplatform),
//                contentDescription = "Logo",
//                modifier = Modifier.size(150.dp)
//            )
//            Spacer(modifier = Modifier.height(32.dp))
//            var username = remember { TextFieldValue() }
//            BasicTextField(
//                value = username,
//                onValueChange = { username = it },
//                textStyle = TextStyle(fontWeight = FontWeight.Normal),
//                modifier = Modifier
//                    .fillMaxWidth()
//                    .border(1.dp, Color.Gray)
//                    .padding(16.dp),
//                decorationBox = { innerTextField ->
//                    Box(Modifier.padding(8.dp)) {
//                        if (username.text.isEmpty()) {
//                            Text("Username", style = TextStyle(color = Color.Gray))
//                        }
//                        innerTextField()
//                    }
//                }
//            )
//            Spacer(modifier = Modifier.height(16.dp))
//            var password = remember { TextFieldValue() }
//            BasicTextField(
//                value = password,
//                onValueChange = { password = it },
//                textStyle = TextStyle(fontWeight = FontWeight.Normal),
//                modifier = Modifier
//                    .fillMaxWidth()
//                    .border(1.dp, Color.Gray)
//                    .padding(16.dp),
//                visualTransformation = VisualTransformation.None,
//                decorationBox = { innerTextField ->
//                    Box(Modifier.padding(8.dp)) {
//                        if (password.text.isEmpty()) {
//                            Text("Password", style = TextStyle(color = Color.Gray))
//                        }
//                        innerTextField()
//                    }
//                }
//            )
//            Spacer(modifier = Modifier.height(32.dp))
//            Button(
//                onClick = { /* Handle sign in logic */ },
//                modifier = Modifier.fillMaxWidth()
//            ) {
//                Text("Sign In", modifier = Modifier.padding(8.dp))
//            }
//        }
//    }
}